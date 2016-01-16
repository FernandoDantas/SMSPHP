<?php

class Sms {

    private $telefoneOrigem;
    private $telefoneDestino;
    private $tipo;
    private $mensagem;
    private $formato;
    private $token;
    private $url = 'https://api.directcallsoft.com/sms/send';

    public function setTelefoneOrigem($telefoneOrigem) {
        $this->telefoneOrigem = $telefoneOrigem;

        return $this;
    }

    public function setTelefoneDestino($telefoneDestino) {
        $this->telefoneDestino = $telefoneDestino;

        return $this;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;

        return $this;
    }

    public function setMensagem($mensagem) {
        $this->mensagem = $mensagem;

        return $this;
    }

    public function setFormato($formato) {
        $this->formato = $formato;

        return $this;
    }

    public function setToken($token) {
        $this->token = $token;

        return $this;
    }

    private function enviarSms() {
        if ($this->formato != 'JSON') {
            throw new Exception("O formato do SMS enviado deve ser um JSON");
        }
        $data = http_build_query(array('origem' => $this->telefoneOrigem, 'destino' => $this->telefoneDestino, 'tipo' => $this->tipo, 'access_token' => $this->token, 'texto' => $this->mensagem));

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $return = curl_exec($ch);

        curl_close($ch);

// Converte os dados de JSON para ARRAY
        return json_decode($return, true);
    }

    public function statusSms() {
        
        var_dump($this->enviarSms());
        if ($this->enviarSms()['status'] == 'ok') {
            return true;
        }
        return false;
    }

}
