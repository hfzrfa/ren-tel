flowchart TD
    A([Start]) --> B[/Buka Website/]
    B --> C[/Input Username & Password/]
    C --> D{Login Valid?}
    D -- Tidak --> C
    D -- Ya --> E{Role?}

    E -- User --> U1[Dashboard User]
    U1 --> U2[Daftar Mobil]
    U2 --> U3{Mobil Tersedia?}
    U3 -- Tidak --> U2
    U3 -- Ya --> U4[/Input Data Pemesanan/]
    U4 --> U5[Simpan Pemesanan]
    U5 --> U6[Riwayat Pemesanan]
    U6 --> Z([End])

    E -- Admin --> A1[Dashboard Admin]
    A1 --> A2{Pilih Menu}
    A2 --> A3[Kelola Data (CRUD)]
    A3 --> A4[Simpan Data]
    A4 --> Z
