<?php
declare(strict_types=1);

namespace src\Utility;

class Access
{
    public const CAN_SHOW = 'can_show';
    public const CAN_ADD = 'can_add';
    public const CAN_EDIT = 'can_edit';
    public const CAN_DELETE = 'can_delete';
    public const CAN_HARD_DELETE = 'can_hard_delete';
    public const CAN_CLONE = 'can_clone';
    public const CAN_LOCK = 'can_lock';
    public const CAN_UNLOCK = 'can_unlock';
    public const CAN_TRASH = 'can_trash';
    public const CAN_RESTORE_TRASH = 'can_restore_trash';
    public const CAN_CHANGE_STATUS = 'can_change_status';
    public const CAN_EDIT_PREFERENCES = 'can_edit_preferences';
    public const CAN_EDIT_PRIVILEGE = 'can_edit_privilege';
    public const CAN_SET_PRIVILEGE_EXPIRATION = 'can_set_privilege_expiration';
    public const CAN_LOG = 'can_log';
    public const CAN_VIEW = 'can_view';
    public const HAVE_BASIC_ACCESS = 'have_basic_access';
    public const HAVE_ADMIN_ACCESS = 'have_admin_access';
    public const CAN_MANAGE_GROUP = 'can_manage_group';
    public const CAN_ASSIGN = 'can_assign';

    public const CAN_BULK_DELETE = 'can_bulk_delete';
    public const CAN_BULK_CLONE = 'can_bulk_clone';
    public const CAN_BULK_RESTORE = 'can_bulk_restore';
    public const CAN_BULK_TRASH = 'can_bulk_trash';
    public const CAN_BULK_UNTRASH = 'can_bulk_untrash';

    public const CAN_EDIT_OWN_ACCOUNT = 'can_edit_own_account';
    public const CAN_UNTRASH = 'can_untrash';
    public const CAN_MANANGE_SETTINGS = 'can_manage_settings';
}