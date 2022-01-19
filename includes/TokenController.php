 <?php

class TokenController
{
    public static function inspectToken($array, $callback)
    {
        if (!empty($array)) {

            if (isset($array['token']) && $array['token'] == '1234') {

                $callback($array);

            } else {

                echo json_encode(['data' => null, 'error' => 'Bad token']);
            }
        }
    }
}

