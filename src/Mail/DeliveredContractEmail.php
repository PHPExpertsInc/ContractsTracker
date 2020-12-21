<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PHPExperts\ContractsTracker\Models\DeliveredContract;

class DeliveredContractEmail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var DeliveredContract */
    private $contract;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(DeliveredContract $contract)
    {
        $this->contract = $contract;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $contractHTML = $this->contract->fetchContractAsHTML();
        $signingURL = config('app.url') . "/contracts-tracker/contract/{$this->contract->id}";

        return $this->view('ContractsTracker::email.showContract')
            ->with([
                'contract' => $this->contract,
                'signingURL' => $signingURL,
                // @FIXME: Need to abstract the emailSender.
                'emailSender' => <<<HTML
                Theodore R. Smith<br/>
                CEO, PHP Experts, Inc.            
                HTML,
            ])
            ->subject("{$this->contract->name}: Please review and sign")
            ->attachData($contractHTML, 'contract.html', ['mime' => 'text/html']);
    }
}
