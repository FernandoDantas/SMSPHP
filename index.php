<?php
require 'sms/Sms.php';
if (isset($_POST['sms'])) {
    $sms = new Sms();
    $sms->setTelefoneOrigem('5583981500294');
    $sms->setTelefoneDestino('5583' . $_POST['sms_telefone_destino']);
    $sms->setTipo('texto');
    $sms->setMensagem($_POST['sms_mensagem']);
    $sms->setToken('Colocar token disponibilizado pela directcall aqui');
    $sms->setFormato('JSON');

    try {
        $smsEnviado = ($sms->statusSms()) ? 'SMS enviado com sucesso !!' : 'Erro ao enviar SMS';
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
   <title>Enviar SMS</title>
   <!-- chamada do semantic ui -->
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.6/semantic.css">
</head>
<body>
   <div class="ui two column centered grid" style="margin-top: 10px;">
      <div class="ui compact segment">

      <?php echo isset($smsEnviado) ? $smsEnviado : ''; ?>

         <h2>Enviar SMS com PHP</h2>
         <div class="ui divider"></div>

         <!-- inicio do formulario -->
         <form class="ui form" method="post" action="">

            <input type="hidden" name="sms">
            <!-- telefone destino -->
              <div class="field">
                <label>Telefone Destino</label>
                <input type="text" name="sms_telefone_destino" placeholder="Telefone destino">
              </div>

            <!-- mensagem -->
              <div class="field">
                <label>Mensagem</label>
                <textarea name="sms_mensagem" placeholder="Mensagem para o destino"></textarea>
              </div>

            <!-- botao enviar mensagem -->
              <button class="ui green button" type="submit">Enviar Mensagem</button>

            <!-- final do formulario -->
         </form>
      </div>
   </div>
</body>
</html>
