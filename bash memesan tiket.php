import tkinter as tk
from tkinter import messagebox

# Data Film dan Jadwal
films = {
    "Avengers: Endgame": ["10:00", "13:00", "16:00"],
    "The Dark Knight": ["11:00", "14:00", "17:00"],
    "Inception": ["09:00", "12:00", "15:00"],
    "Titanic": ["10:30", "13:30", "16:30"]
}

# Daftar Kursi yang tersedia
available_seats = ["A1", "A2", "A3", "B1", "B2", "B3", "C1", "C2", "C3"]

# Fungsi untuk menampilkan informasi pemesanan
def show_ticket_info():
    film = film_var.get()
    time = time_var.get()
    seat = seat_var.get()

    if film == "" or time == "" or seat == "":
        messagebox.showwarning("Peringatan", "Harap pilih film, waktu, dan kursi terlebih dahulu.")
    else:
        messagebox.showinfo("Informasi Tiket", f"Film: {film}\nWaktu: {time}\nKursi: {seat}\nPemesanan berhasil!")

# Fungsi untuk mengupdate pilihan waktu berdasarkan film yang dipilih
def update_times():
    selected_film = film_var.get()
    time_menu["menu"].delete(0, "end")
    
    if selected_film != "":
        for time in films[selected_film]:
            time_menu["menu"].add_command(label=time, command=tk._setit(time_var, time))

# Fungsi untuk mengupdate pilihan kursi
def update_seats():
    seat_menu["menu"].delete(0, "end")
    for seat in available_seats:
        
