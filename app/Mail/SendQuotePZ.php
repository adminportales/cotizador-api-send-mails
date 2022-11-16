<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendQuotePZ extends Mailable
{
    use Queueable, SerializesModels;

    public $theme = 'default';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $vendedor, $cliente, $file, $email;
    public function __construct($vendedor, $cliente, $file, $email)
    {
        $this->vendedor = $vendedor;
        $this->cliente = $cliente;
        $this->file = $file;
        $this->email = $email;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.quotepdf.pz')
            ->with('cliente', $this->cliente)
            ->with('vendedor', $this->vendedor)
            ->subject('Cotizacion Promo Zale')
            ->from($this->email, $this->vendedor)
            ->attach($this->file, [
                'as' => 'Hoja de Cotizacion.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}
