<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\HelpFuntionController;
use Illuminate\Support\Facades\File;
use App\Models\Usuario;
use App\Models\Product;
use App\Models\Trolley;
use App\Models\Purchaorder;
class EviarCorreo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    use Queueable, SerializesModels;

    public $dato; // Definimos la variable que pasaremos al correo

    /**
     * Create a new message instance.
     */
    public function __construct($id)
    {
        // Aquí asignamos el valor a la variable $dato
        $this->dato = Purchaorder::with(['Usuario', 'Trolley.product', 'repartido', 'cliente'])
            ->has('Usuario')
            ->has('Trolley')
            ->has('repartido')
            ->latest()
            ->has('cliente')->find($id);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Enviar Correo',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->view('purchaorder.correoenviar')
                    ->with('dato', $this->dato); // Pasamos la variable $dato a la vista
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
