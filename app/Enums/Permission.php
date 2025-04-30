<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Permission extends Enum
{
    // Akses dasbor
    const DASHBOARD_VIEW = 'dashboard.view';

    // Manajemen pos
    const POST_VIEW = 'post.view';

    const POST_CREATE = 'post.create';

    const POST_EDIT = 'post.edit';

    const POST_DELETE = 'post.delete';

    const POST_PUBLISH = 'post.publish';

    // Manajemen topik
    const TOPIC_VIEW = 'topic.view';

    const TOPIC_CREATE = 'topic.create';

    const TOPIC_EDIT = 'topic.edit';

    const TOPIC_DELETE = 'topic.delete';

    // Manajemen komentar
    const COMMENT_VIEW = 'comment.view';

    const COMMENT_CREATE = 'comment.create';

    const COMMENT_EDIT = 'comment.edit';

    const COMMENT_DELETE = 'comment.delete';

    const COMMENT_MODERATE = 'comment.moderate';

    // Manajemen pengguna
    const USER_VIEW = 'user.view';

    const USER_CREATE = 'user.create';

    const USER_EDIT = 'user.edit';

    const USER_DELETE = 'user.delete';
}
