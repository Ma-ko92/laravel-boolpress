<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPostAdminNotification extends Mailable
{
    use Queueable, SerializesModels;

    // Setto l'attributo
    protected $new_post;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // Passo l'attributo come argomento
    public function __construct($_new_post)
    {
        // l'attributo sarà uguale a ciò che è stato creato nel momento in cui è stata stanziata la classe
        $this->new_post = $_new_post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Per passare le informazioni del nuovo post alla view

        $data = [
            'new_post' => $this->new_post
        ];
        // La view conterrà il codice html della mail( le mai sono sempre codice html, non supportano
        // javascript e il css va inserito inline)
        return $this->view('emails.new-post-admin-notifications', $data);
    }
}
