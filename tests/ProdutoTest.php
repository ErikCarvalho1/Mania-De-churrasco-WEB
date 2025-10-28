<?php
namespace tests;

use App\Produto;
use PHPUnit\Framework\TestCase;

class ProdutoTest extends TestCase
 {
    public function testBuscarPorTipoIdRetornaArray(){
        $produto = new Produto();
        $resultado  = $produto->buscarPorId(1);
        $this->assertIsArray($resultado);
    }
    public  function testBuscarPorStringRetornaArray(){
        $produto = new Produto();
        $resultado = $produto->buscarPorString("Picanha");
        $this->assertIsArray($resultado);
    }
    public function testListarRetornaArray(){
        $produto = new Produto();
         $resultado = $produto->listar();
        $this->assertIsArray($resultado);
    }
 }
?>