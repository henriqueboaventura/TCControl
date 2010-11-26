<?php if(!$sf_user->hasCredential('administrador')): ?>
<h4>Mensagens</h4>
<ul id="mensagens">
    <li><?php echo link_to('Nova Mensagem', 'mensagem/new'); ?></li>
    <li><?php echo link_to('Caixa de Entrada', '@mensagens'); ?></li>
    <li><?php echo link_to('Caixa de Saida', '@mensagens_enviadas'); ?></li>
</ul>
<?php endif; ?>
<?php if($sf_user->hasCredential('administrador') OR ($sf_user->hasCredential('professor') AND $sf_user->getAttribute('coordenador',false,'professor'))): ?>
<h4>Administração</h4>
<ul>
    <?php if($sf_user->hasCredential('administrador')):?>
    <li>Sistema
        <ul>
            <li><?php echo link_to('Configurações', 'configuracao/index'); ?></li>
            <!--<li><?php //echo link_to('Cursos', 'curso/index'); ?></li>-->
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
    <?php if($sf_user->hasCredential('professor')):?>
    <li>Orientandos
        <ul>
            <li><?php echo link_to('Sem Orientador','@sem_orientador_list');?></li>
            <li><?php echo link_to('Aguardando Aprovação<span>(' . $orientacoesExtraPendentes->count() . ')</span>','@orientandos_coordenador_list');?></li>
        </ul>
    </li>
    <li>Propostas
        <ul>
            <li><?php echo link_to('Aguardando Avaliação<span>(' . $propostasPendentes->count() . ')</span>','@proposta_coordenador_list?filtro=aguardando');?></li>
            <li><?php echo link_to('Aprovadas','@proposta_coordenador_list?filtro=aprovado');?></li>
            <li><?php echo link_to('Rejeitadas','@proposta_coordenador_list?filtro=rejeitado');?></li>
        </ul>
    </li>
    <li>Banca
        <ul>
            <li><?php echo link_to('Agendar','@banca_agendar');?></li>
            <li><?php echo link_to('Listar','@bancas');?></li>
            <li><?php echo link_to('Registrar Avaliação','@bancas_avaliacao');?></li>
        </ul>
    </li>
    <li>Relatórios
        <ul>
            <li><?php echo link_to('Alunos matriculados','@relatorio?tipo=alunosMatriculados');?></li>
            <li><?php echo link_to('Alunos com seu Orientador','@relatorio?tipo=alunosOrientador');?></li>
            <li><?php echo link_to('Orientador e Alunos','@relatorio?tipo=orientadorAlunos');?></li>
            <li><?php echo link_to('Propostas','@relatorio?tipo=propostas');?></li>
            <li><?php echo link_to('Horário das Bancas','@relatorio?tipo=horarioBancas');?></li>
            <li><?php echo link_to('Resultado das Bancas','@relatorio?tipo=resultadoBancas');?></li>
        </ul>
    </li>
    <!--<li>Artigos
        <ul>
            <li><?php echo link_to('Aguardando Avaliação<span>(' . $propostasPendentes->count() . ')</span>','@proposta_coordenador_list?filtro=aguardando');?></li>
            <li><?php echo link_to('Avaliados','@proposta_coordenador_list?filtro=aprovado');?></li>
        </ul>
    </li>-->
    <?php endif; ?>
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
    <li>Arquivos
        <ul>
            <li><?php echo link_to('Gerenciar', 'arquivo/index'); ?></li>
        </ul>
    </li>
    <li>Plano de Trabalho
        <ul>
            <li><?php echo link_to('Definir Proposta', '@proposta'); ?></li>
            <li><?php echo link_to('Definir Cronograma', 'cronograma/index'); ?></li>                                    
        </ul>        
    </li>
    <?php if($sf_user->getAttribute('semestre',false,'TCC2')): ?>
    <li>Artigo
        <ul>
            <li><?php echo link_to('Definir', '@artigo'); ?></li>
            <li><?php echo link_to('Histórico de versões', '@artigo_history');?></li>
        </ul>   
    </li>
    <?php endif; ?>
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
            
            <li><?php echo link_to('Aguardando Aceitação<span>(' . $orientacoesPendentes->count() . ')</span>','@orientandos_list?filtro=aguardando');?></li>
            <li><?php echo link_to('Aprovados','@orientandos_list?filtro=aprovado');?></li>
        </ul>
    </li>
    <li>Arquivos
        <ul>
            <li><?php echo link_to('Gerenciar', 'arquivo/index'); ?></li>
            <?php if($sf_user->getAttribute('coordenador',false,'professor')) :  ?>
            <li><?php echo link_to('Visualizar todos','@arquivos');?></li>
            <?php endif; ?>
        </ul>
    </li>
    <li>Propostas
        <ul>
            <li><?php echo link_to('Acompanhar','@proposta_list?filtro=todas');?></li>
            <?php if($sf_user->getAttribute('coordenador',false,'professor')) :  ?>
            <li><?php echo link_to('Acompanhar Todas','@propostas');?></li>
            <?php endif; ?>
        </ul>
    </li>    
    <li>Artigo
        <ul>
            <li><?php echo link_to('Acompanhar','@artigo_list?filtro=todas');?></li>
            <?php if($sf_user->getAttribute('coordenador',false,'professor')) :  ?>
            <li><?php echo link_to('Acompanhar Todos','@artigos');?></li>
            <?php endif; ?>
        </ul>
    </li>
</ul>

<?php endif; ?>

