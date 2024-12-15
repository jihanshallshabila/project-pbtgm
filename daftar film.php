import tkinter as tk
from tkinter import messagebox

# Daftar film yang akan ditampilkan
films = [
    "Avengers: Endgame",
    "The Dark Knight",
    "Inception",
    "Interstellar",
    "The Matrix",
    "Spider-Man: No Way Home",
    "Titanic",
    "Jurassic Park",
    "The Godfather",
    "Pulp Fiction"
]

# Fungsi untuk menampilkan informasi tentang film
def show_movie_info(selected_movie):
    messagebox.showinfo("Informasi Film", f"Detail tentang film: {selected_movie}")

# Membuat window utama
root = tk.Tk()
root.title("Daftar Film Bioskop")

# Menampilkan label
label = tk.Label(root, text="Pilih film untuk melihat detail:", font=("Arial", 14))
label.pack(pady=10)

# Membuat listbox untuk menampilkan daftar film
movie_listbox = tk.Listbox(root, height=10, width=50, font=("Arial", 12))
for movie in films:
    movie_listbox.insert(tk.END, movie)
movie_listbox.pack(pady=10)

# Fungsi untuk menangani klik pada item listbox
def on_movie_select(event):
    selected_movie_index = movie_listbox.curselection()
    if selected_movie_index:
        selected_movie = movie_listbox.get(selected_movie_index)
        show_movie_info(selected_movie)

# Bind event ketika pengguna memilih film
movie_listbox.bind("<<ListboxSelect>>", on_movie_select)

# Menjalankan aplikasi
root.mainloop()
