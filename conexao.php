<?php
function abrirBanco() {
    $conexao = new mysqli("localhost", "user", "password", "db");
    return $conexao;
}

function alterar($tabela, $dados, $criterio) {
    $banco = abrirBanco();
    $sql = "UPDATE $tabela SET $dados WHERE $criterio";
    $banco->query($sql);
    $banco->close();
}

function selecionar($tabela, $selecao="*", $criterio=null, $ordem=null) {
    $banco = abrirBanco();
    $sql = "SELECT $selecao FROM $tabela";
    if ($criterio != null) {
        $sql .= " WHERE $criterio";
    }
    if ($ordem != null) {
        $sql .= " ORDER BY $ordem";
    }
    $resultado = $banco->query($sql);
    $banco->close();
    $item = mysqli_fetch_assoc($resultado);
    return $item;
}

function selecionarLista($tabela, $selecao="*", $criterio=null, $ordem=null) {
    $banco = abrirBanco();
    $sql = "SELECT $selecao FROM $tabela";
    if ($criterio != null) {
        $sql .= " WHERE $criterio";
    }
    if ($ordem != null) {
        $sql .= " ORDER BY $ordem";
    }
    $resultado = $banco->query($sql);
    $banco->close();
    while($row = mysqli_fetch_assoc($resultado)) {
        $grupo[] = $row;
    }
    return $grupo;
}
?>