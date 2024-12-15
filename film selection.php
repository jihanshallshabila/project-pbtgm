# Film selection
film_var = tk.StringVar(value="")
film_label = tk.Label(root, text="Pilih Film:", font=("Arial", 14))
film_label.pack(pady=5)
film_menu = tk.OptionMenu(root, film_var, *films.keys(), command=lambda _: update_times())
film_menu.pack(pady=5)