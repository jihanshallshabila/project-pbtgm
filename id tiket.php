import tkinter as tk
from tkinter import messagebox
import uuid

# Data Film, Waktu, Harga, dan Jumlah Tiket
films = {
    "Avengers: Endgame": {
        "times": ["10:00", "13:00", "16:00"], "price": 100, "available_tickets": 10
    },
    "The Dark Knight": {
        "times": ["11:00", "14:00", "17:00"], "price": 80, "available_tickets": 8
    },
    "Inception": {
        "times": ["09:00", "12:00", "15:00"], "price": 90, "available_tickets": 12
    },
    "Titanic": {
        "times": ["10:30", "13:30", "16:30"], "price": 70, "available_tickets": 5
    }
}

# Penyimpanan pesanan dengan ID
bookings = {}

# Fungsi untuk membuat ID tiket unik
def generate_ticket_id():
    return str(uuid.uuid4())

# Fungsi untuk menampilkan informasi pemesanan
def show_ticket_info():
    film = film_var.get()
    time = time_var.get()
    seat = seat_var.get()

    if film == "" or time == "" or seat == "":
        messagebox.showwarning("Peringatan", "Harap pilih film, waktu, dan kursi terlebih dahulu.")
    else:
        # Mengurangi jumlah tiket yang tersedia
        films[film]["available_tickets"] -= 1

        # Menghasilkan ID tiket unik
        ticket_id = generate_ticket_id()

        # Menyimpan informasi pesanan
        bookings[ticket_id] = {
            "film": film,
            "time": time,
            "seat": seat,
            "price": films[film]["price"]
        }

        # Menampilkan informasi tiket yang dipesan
        ticket_info = f"ID Tiket: {ticket_id}\nFilm: {film}\nWaktu: {time}\nKursi: {seat}\nHarga: ${films[film]['price']}\nPemesanan berhasil!"
        messagebox.showinfo("Informasi Tiket", ticket_info)

        # Update jumlah tiket yang tersedia
        update_ticket_info()

        # Reset pilihan film, waktu, dan kursi
        film_var.set("")
        time_var.set("")
        seat_var.set("")

# Fungsi untuk mengupdate pilihan waktu berdasarkan film yang dipilih
def update_times():
    selected_film = film_var.get()
    time_menu["menu"].delete(0, "end")
    
    if selected_film != "":
        for time in films[selected_film]["times"]:
            time_menu["menu"].add_command(label=time, command=tk._setit(time_var, time))
        update_ticket_info()

# Fungsi untuk mengupdate informasi tiket yang tersedia
def update_ticket_info():
    selected_film = film_var.get()
    available_tickets_label.config(text=f"Tiket Tersedia: {films[selected_film]['available_tickets']}")

# Fungsi untuk mengupdate pilihan kursi
def update_seats():
    seat_menu["menu"].delete(0, "end")
    for seat in available_seats:
        seat_menu["menu"].add_command(label=seat, command=tk._setit(seat_var, seat))

# Fungsi untuk menghapus pesanan berdasarkan ID tiket
def cancel_booking_by_id():
    ticket_id = ticket_id_var.get()

    if ticket_id == "":
        messagebox.showwarning("Peringatan", "Harap masukkan ID tiket untuk membatalkan pesanan.")
        return

    if ticket_id not in bookings:
        messagebox.showerror("Error", "ID Tiket tidak valid atau tidak ditemukan.")
        return

    # Dapatkan informasi pesanan yang akan dibatalkan
    booking = bookings[ticket_id]
    
    # Mengembalikan jumlah tiket yang tersedia
    films[booking["film"]]["available_tickets"] += 1

    # Menghapus pesanan dari data pemesanan
    del bookings[ticket_id]

    # Menampilkan informasi pembatalan
    messagebox.showinfo("Pembatalan Pesanan", f"Pesanan dengan ID {ticket_id} telah dibatalkan.\nJumlah tiket yang tersedia telah dikembalikan.")
    
    # Update UI dengan tiket yang tersedia
    update_ticket_info()

    # Reset input ID tiket
    ticket_id_var.set("")

# Membuat window utama
root = tk.Tk()
root.title("Sistem Pemesanan Tiket Bioskop")

# Film selection
film_var = tk.StringVar(value="")
film_label = tk.Label(root, text="Pilih Film:", font=("Arial", 14))
film_label.pack(pady=5)
film_menu = tk.OptionMenu(root, film_var, *films.keys(), command=lambda _: update_times())
film_menu.pack(pady=5)

# Tiket Tersedia Info
available_tickets_label = tk.Label(root, text="Tiket Tersedia: 0", font=("Arial", 12))
available_tickets_label.pack(pady=5)

# Time selection
time_var = tk.StringVar(value="")
time_label = tk.Label(root, text="Pilih Waktu:", font=("Arial", 14))
time_label.pack(pady=5)
time_menu = tk.OptionMenu(root, time_var, *[])
time_menu.pack(pady=5)

# Seat selection
seat_var = tk.StringVar(value="")
seat_label = tk.Label(root, text="Pilih Kursi:", font=("Arial", 14))
seat_label.pack(pady=5)
seat_menu = tk.OptionMenu(root, seat_var, *[])
seat_menu.pack(pady=5)

# Button untuk memesan tiket
book_button = tk.Button(root, text="Pesan Tiket", font=("Arial", 14), command=show_ticket_info)
book_button.pack(pady=20)

# Input ID Tiket untuk pembatalan
cancel_label = tk.Label(root, text="Masukkan ID Tiket untuk Membatalkan:", font=("Arial", 12))
cancel_label.pack(pady=5)

ticket_id_var = tk.StringVar()
ticket_id_entry = tk.Entry(root, textvariable=ticket_id_var, font=("Arial", 12))
ticket_id_entry.pack(pady=5)

# Button untuk membatalkan pesanan
cancel_button = tk.Button(root, text="Batalkan Pesanan", font=("Arial", 14), command=cancel_booking_by_id)
cancel_button.pack(pady=10)

# Jalankan aplikasi
root.mainloop()
