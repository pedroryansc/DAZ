window.onload = (function (){
    const xhttp = new XMLHttpRequest();  // cria o objeto que fará a conexão assíncrona
    xhttp.onload = function() {  // executa essa função quando receber resposta do servidor
        resposta = JSON.parse(this.responseText); // os dados são convertidos para objeto javascript
    }
    // configuração dos parâmetros da conexão assíncrona
    xhttp.open("POST", "../resp/resposta.php", true);  // arquivo que será acessado no servidor remoto  
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // cabeçalhos - necessário para requisição POST
    xhttp.send("resposta=" + resposta + "&alunoid=" + alunoid); // parâmetros para a requisição
}
filegetcontex
jsonencode