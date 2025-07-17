<?php

namespace App\Enums;

enum ConversationStatusEnum: string
{
    case DELIVERED = 'delivered';
    case ERROR = 'error';
    case SEEN = 'seen';
    case SENDING = 'sending';
    case SENT = 'sent';
}
