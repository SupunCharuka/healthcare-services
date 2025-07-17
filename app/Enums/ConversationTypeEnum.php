<?php

namespace App\Enums;

enum ConversationTypeEnum: string
{
    case AUDIO = 'audio';
    case CUSTOM = 'custom';
    case FILE = 'file';
    case IMAGE = 'image';
    case SYSTEM = 'system';
    case TEXT = 'text';
    case UNSUPPORTED = 'unsupported';
    case VIDEO = 'video';
}
