<?php

namespace Source\Support\Log\handler;

interface HandlerInterface
{
    /*
    *  handler é o metodo que decide executar ou não os processos
    *  do objeto handler em questão 
    */

    public function handle(array $log): void;

    /*
    *  isHandler é o metodo que verifica o level do log recebido
    */

    public function isHandling(array $log): bool;

}