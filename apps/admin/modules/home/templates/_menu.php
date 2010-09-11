<h4>Administração</h4>
<ul>
    <li>Sistema
        <ul>
            <li><?php echo link_to('Configurações', '@home'); ?></li>    
        </ul>
    </li>
    <li>Usuários
        <ul>
            <li><?php echo link_to('Administradores', 'administrador/index'); ?></li>
            <li><?php echo link_to('Professores', 'professor/index'); ?></li>
            <li><?php echo link_to('Alunos', 'aluno/index'); ?></li>
        </ul>
    </li>
</ul>
