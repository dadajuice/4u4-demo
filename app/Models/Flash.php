<?php

class Flash
{
    public static function displayError(): void
    {
        self::display("error", "danger");
    }

    public static function displaySuccess(): void
    {
        self::display("success");
    }

    public static function displayAll(): void
    {
        self::display("error", "danger");
        self::display("success");
    }

    public static function error(string|array $messages): void
    {
        self::registerMessage($messages, 'error');
    }

    public static function success(string|array $messages): void
    {
        self::registerMessage($messages, 'success');
    }

    private static function registerMessage(string|array $messages, string $type): void
    {
        if (!isset($_SESSION[$type])) {
            $_SESSION[$type] = [];
        }
        if (is_array($messages)) {
            $_SESSION[$type] = array_merge($_SESSION[$type], $messages);
        } else {
            $_SESSION[$type][] = $messages;
        }
    }

    private static function display(string $type, ?string $cssClass = null): void
    {
        $class = $cssClass ?? $type;
        if (!empty($_SESSION[$type] ?? "")) {
            ?>
            <div class="alert alert-<?= $class ?>">
                <?php
                if (count($_SESSION[$type]) > 1) {
                    ?>
                    <ul class="mb-0">
                        <?php foreach ($_SESSION[$type] as $message): ?>
                            <li><?= $message ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php
                } else {
                    echo $_SESSION[$type][0];
                }
                ?>
            </div>
            <?php
            unset($_SESSION[$type]);
        }
    }
}
