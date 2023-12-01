<?php
class Usuarios{
	private PDO $conexao;

	public function __construct(PDO $conexao) {
		$this->conexao = $conexao;
	}

    public function create(Usuario $usuario): void {
		$sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
		$stmt = $this->conexao->prepare($sql);
		$stmt->execute([$usuario->nome, $usuario->email, $usuario->senha]);
	}

    public function read(int $id): ?Usuario {
		$sql = "SELECT * FROM usuarios WHERE id = ?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->execute([$id]);
		return $stmt->fetchObject('Usuario') ?: null;
	}

    public function update(Usuario $usuario): void {
		$sql = "UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->execute([$usuario->nome, $usuario->email, $usuario->senha, $usuario->id]);
	}

    public function delete(int $id): void {
		$sql = "DELETE FROM usuarios WHERE id = ?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->execute([$id]);
	}

    public function getAll(): array {
		$sql = "SELECT * FROM usuarios";
		$stmt = $this->conexao->query($sql);
		return $stmt->fetchAll(PDO::FETCH_CLASS, 'Usuario');
	}
}