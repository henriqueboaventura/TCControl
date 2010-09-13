<?php if($sf_user->hasCredential('administrador') OR ($sf_user->hasCredential('professor') AND $sf_user->getAttribute('coordenador',false,'professor'))): ?>
<h4>Administração</h4>
<ul>
    <?php if($sf_user->hasCredential('administrador')):?>
    <li>Sistema
        <ul>
            <li><?php echo link_to('Configurações', 'configuracao/index'); ?></li>
        </ul>
    </li>
    <?php endif; ?>
    <li>Usuários
        <ul>
            <?php if($sf_user->hasCredential('administrador')): ?>
            <li><?php echo link_to('Administradores', 'administrador/index'); ?></li>
            <?php endif; ?>
            <li><?php echo link_to('Professores', 'professor/index'); ?></li>
            <li><?php echo link_to('Alunos', 'aluno/index'); ?></li>
        </ul>
    </li>
</ul>
<?php endif; ?>
<?php if($sf_user->hasCredential('aluno')): ?>
<h4>Definições</h4>
<ul>
    <li>Orientador
        <ul>
            <li><?php echo link_to('Escolher Professor', '@orientador_list'); ?></li>
        </ul>
    </li>
    <li>Plano de Trabalho
        <ul>
            <li><?php echo link_to('Definir Proposta', '@home'); ?></li>
        </ul>
    </li>
</ul>
<?php endif; ?>
<?php if($sf_user->hasCredential('professor')): ?>
<h4>Definições</h4>
<ul>
    <li>Orientandos
        <ul>
            <li><?php echo link_to('Aguardando Aprovação(0)','@orientandos_list?filtro=aguardando');?></li>
        </ul>
    </li>
</ul>

<?php endif; ?>

