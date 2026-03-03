<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class StokNotifikasi extends Notification
{
    use Queueable;

    // ✅ TAMBAHKAN INI
    protected $barang;
    protected $tipe;

    // ✅ TAMBAHKAN CONSTRUCTOR DI SINI
    public function __construct($barang, $tipe)
    {
        $this->barang = $barang;
        $this->tipe   = $tipe;
    }

    public function via($notifiable)
    {
        if ($this->tipe == 'habis' && $notifiable->level == 'operator') {
            return ['database', 'mail'];
        }

        return ['database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Stok Barang Habis')
            ->line('Stok barang HABIS.')
            ->line('Nama Barang: ' . $this->barang->nama_barang);
    }

    public function toArray($notifiable)
    {
        return [
            'nama_barang' => $this->barang->nama_barang,
            'stok'        => $this->barang->stok,
            'tipe'        => $this->tipe,
            'pesan'       => $this->tipe == 'habis'
                ? 'Stok barang HABIS!'
                : 'Stok barang menipis!',
        ];
    }
}
