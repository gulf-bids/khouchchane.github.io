<?php

unset($_COOKIE['USER_LOGGED']);
setcookie('USER_LOGGED', null, -1, '/');

header("Location: login");
