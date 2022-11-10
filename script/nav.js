function abrirPerfil(){
    document.getElementById("barralat").style.width = "400px";
}
function fecharPerfil(){
    document.getElementById("barralat").style.width = "0";
}

function excluirRegistro(url){
    if(confirm("Excluir perfil: Esta ação não pode ser desfeita. Tem certeza?"))
        location.href = url;
}

function sairSistema(url){
    if(confirm("Sair do Sistema: Tem certeza?"))
        location.href = url;
}