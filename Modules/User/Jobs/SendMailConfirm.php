<?php

namespace Modules\User\Jobs;

use Modules\User\Jobs\Job;
use Illuminate\Mail\Mailer;
use Modules\User\Model\DoctrineORM\Entity\User;
use Illuminate\Contracts\Bus\SelfHandling;

class SendMailConfirm extends Job implements SelfHandling
{

    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $data = [
            'title'             => trans('user.email.title'),
            'intro'             => trans('user.email.intro'),
            'confirmation_code' => $this->user->getConfirmationCode(),
        ];

        $mailer->send('user::email.auth.verify', $data, function($message) {
            $message->to($this->user->getEmail(), $this->user->getUsername())
                    ->subject(trans('user.email.subject'));
        });
    }

}
