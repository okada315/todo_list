<?php

class Config
{
    const DB_NAME = 'todo';

    const DB_HOST = '127.0.0.1';

    const DB_USER = 'root';

    const DB_PASS = '';


    const RANDOM_PSEUDO_STRING_LENGTH = 32;


    const MSG_INVALID_PROCESS = '不正な処理が行われました。';

    const MSG_EXCEPTION = '申し訳ございません。エラーが発生しました。';

    const MSG_USER_DUPLICATE = '既に同じメールアドレスが登録されています。';

    const MSG_USER_LOGIN_FAILURE = 'メールアドレス、または、パスワードに誤りがあります。';

    const MSG_USER_LOGIN_TRY_TIMES_OVER = 'ログインできません';

    const MSG_UPLOAD_FAILURE = 'アップロードに失敗しました。';
}