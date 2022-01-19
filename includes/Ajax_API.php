   <?php

require __DIR__ . '/TokenController.php';

class Ajax_API extends API_Config {

    public function __construct()
    {
        TokenController::inspectToken($_GET, function($data){
            echo $this->filterRequest($data);
        });
    }

    private function filterRequest($data)
    {
        if (isset($data['table']) && ($data['table'] === 'articles' || $data['table'] === 'users')) {

            if (isset($data['data'])) {

                return json_encode(['data' => $this->getOneFrom($data['table'], $data['data']), 'error' => null]);

            } else {

                return json_encode(['data' => $this->getAllTable($data['table']), 'error' => null]);
            }

        } else {

            return json_encode(['data' => null, 'error' => 'Bad table']);
        }
    }
}

