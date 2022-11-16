<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendQuoteGeneric extends Mailable
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
        return $this->markdown('mail.quotepdf.generic')
            ->with('cliente', $this->cliente)
            ->with('vendedor', $this->vendedor)
            ->with('email', $this->email)
            ->subject('Cotizacion Promo Zale')
            ->from($this->email, $this->vendedor);
            // ->attach(public_path() . $this->file, [
            //     'as' => 'Hoja de Cotizacion.pdf',
            //     'mime' => 'application/pdf',
            // ]);
    }
}
