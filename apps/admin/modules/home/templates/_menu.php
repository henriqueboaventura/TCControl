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
            <li><?php echo link_to('Administradores', 'administrador/list'); ?></li>
            <?php endif; ?>
            <li><?php echo link_to('Professores', 'professor/index'); ?></li>
            <li><?php echo link_to('Alunos', 'aluno/index'); ?></li>
        </ul>
    </li>
    <?php if($sf_user->hasCredential('professor')):?>
    <li>Orientandos
        <ul>
            <li><?php echo link_to('Sem Orientador','@sem_orientador_list');?></li>
            <li><?php echo link_to('Aguardando Aprovação(' . $orientacoesExtraPendentes->count() . ')','@orientandos_coordenador_list');?></li>
        </ul>
    </li>
    <li>Propostas
        <ul>
            <li><?php echo link_to('Aguardando Aprovação(' . $propostasPendentes->count() . ')','@proposta_coordenador_list?filtro=aguardando');?></li>
            <li><?php echo link_to('Aprovadas','@proposta_coordenador_list?filtro=aprovado');?></li>
            <li><?php echo link_to('Rejeitadas','@proposta_coordenador_list?filtro=rejeitado');?></li>
        </ul>
    </li>
    <?php endif; ?>
</ul>
<?php endif; ?>
<h4>Mensagens</h4>
<ul>
    <li><?php echo link_to('Caixa de Entrada', '@home'); ?></li>
</ul>
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
    <li>Artigo
        <ul>
            <li><?php echo link_to('Definir', '@artigo'); ?></li>
            <li>Histórico de versões</li>
        </ul>   
    </li>    
</ul>
<?php endif; ?>
<?php if($sf_user->hasCredential('professor')): ?>
<h4>Definições</h4>
<ul>
    <li>Professor
        <ul>
            <li><?php echo link_to('Areas de Afinidade','areaAfinidade/list');?></li>
            <li><?php echo link_to('Areas de Interesse','areaInteresse/index');?></li>
        </ul>
    </li>
    <li>Orientandos
        <ul>            
            
            <li><?php echo link_to('Aguardando Aceitação(' . $orientacoesPendentes->count() . ')','@orientandos_list?filtro=aguardando');?></li>
            <li><?php echo link_to('Aprovados','@orientandos_list?filtro=aprovado');?></li>
        </ul>
    </li>
    <li>Propostas
        <ul>
            <li><?php echo link_to('Acompanhar','@proposta_list?filtro=todas');?></li>
        </ul>
    </li>
</ul>

<?php endif; ?>

