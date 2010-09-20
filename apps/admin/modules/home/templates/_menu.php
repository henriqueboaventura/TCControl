<?php if($sf_user->hasCredential('administrador') OR ($sf_user->hasCredential('professor') AND $sf_user->getAttribute('coordenador',false,'professor'))): ?>
<h4>Administração</h4>
<ul>
    <?php if($sf_user->hasCredential('administrador')):?>
    <li>Sistema
        <ul>
            <li><?php echo link_to('Configurações', 'configuracao/index'); ?></li>
            <li><?php echo link_to('Cursos', 'curso/index'); ?></li>
            <li><?php echo link_to('Areas de Afinidade','areaAfinidade/index');?></li>
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
            <li><?php echo link_to('Definir Proposta', '@proposta'); ?></li>
            <li><?php echo link_to('Definir Cronograma', 'cronograma/index'); ?></li>
        </ul>
    </li>
</ul>
<?php endif; ?>
<?php if($sf_user->hasCredential('professor')): ?>
<h4>Definições</h4>
<ul>
    <li>Professor
        <ul>
            <li><?php echo link_to('Areas de Afinidade','areaAfinidade/index');?></li>
            <li><?php echo link_to('Areas de Interesse','areaInteresse/index');?></li>
        </ul>
    </li>
    <li>Orientandos
        <ul>
            <li><?php echo link_to('Aguardando Aceitação(' . $orientacoesPendentes->count() . ')','@orientandos_list?filtro=aguardando');?></li>
            <li><?php echo link_to('Aprovados','@orientandos_list?filtro=aprovado');?></li>
            <?php if($sf_user->getAttribute('coordenador',false,'professor')): ?>
            <li><?php echo link_to('Rejeitados','@orientandos_list?filtro=rejeitado');?></li>
            <?php endif; ?>
        </ul>
    </li>
    <li>Propostas
        <ul>
            <li><?php echo link_to('Aguardando Aprovação(' . $propostasPendentes->count() . ')','@proposta_list?filtro=aguardando');?></li>
            <li><?php echo link_to('Aprovadas','@proposta_list?filtro=aprovado');?></li>
            <?php if($sf_user->getAttribute('coordenador',false,'professor')): ?>
            <li><?php echo link_to('Rejeitadas','@proposta_list?filtro=rejeitado');?></li>
            <?php endif; ?>
        </ul>
    </li>
</ul>

<?php endif; ?>

