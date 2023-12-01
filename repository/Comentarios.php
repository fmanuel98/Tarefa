<?php
class Comentarios {
	private PDO $conexao;

	public function __construct(PDO $conexao) {
		$this->conexao = $conexao;
	}

    public function create(Comentario $comentario): void {
		$sql = "INSERT INTO comentarios (usuario_id, comentario, created_at) VALUES (?, ?, ?)";
		$stmt = $this->conexao->prepare($sql);
		$stmt->execute([$comentario->usuario_id, $comentario->comentario, $comentario->created_at]);
	}

    public function read(int $id): ?Comentario {
		$sql = "SELECT * FROM comentarios WHERE id = ?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->execute([$id]);
		return $stmt->fetchObject(Comentario::class) ?: null;
	}

    public function update(Comentario $comentario): void {
		$sql = "UPDATE comentarios SET usuario_id = ?, comentario = ?, created_at = ? WHERE id = ?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->execute([$comentario->usuario_id, $comentario->comentario, $comentario->created_at, $comentario->id]);
	}

    public function delete(int $id): void {
		$sql = "DELETE FROM comentarios WHERE id = ?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->execute([$id]);
	}

    public function getAll(): array {
		$sql = "SELECT * FROM comentarios";
		$stmt = $this->conexao->query($sql);
		return $stmt->fetchAll(PDO::FETCH_CLASS, Comentario::class);
	}
}