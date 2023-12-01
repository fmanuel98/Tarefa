<?php
class Comentarios{
	private PDO $conexao;

	public function __construct(PDO $conexao) {
		$this->conexao = $conexao;
	}
	
	public function create(Artigo $artigo): void {
		$sql = "INSERT INTO artigos (titulo, usuario_id, comentario_id, artigo, path_file, created_at) VALUES (?, ?, ?, ?, ?, ?)";
		$stmt = $this->conexao->prepare($sql);
		$stmt->execute([$artigo->titulo, $artigo->usuario_id, $artigo->comentario_id, $artigo->artigo, $artigo->path_file, $artigo->created_at]);
	}

    public function read(int $id): ?Artigo {
		$sql = "SELECT * FROM artigos WHERE id = ?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->execute([$id]);
		return $stmt->fetchObject(Artigo::class) ?: null;
	}

    public function update(Artigo $artigo): void {
		$sql = "UPDATE artigos SET titulo = ?, usuario_id = ?, comentario_id = ?, artigo = ?, path_file = ?, created_at = ? WHERE id = ?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->execute([$artigo->titulo, $artigo->usuario_id, $artigo->comentario_id, $artigo->artigo, $artigo->path_file, $artigo->created_at, $artigo->id]);
	}

    public function delete(int $id): void {
		$sql = "DELETE FROM artigos WHERE id = ?";
		$stmt = $this->conexao->prepare($sql);
		$stmt->execute([$id]);
	}

    public function getAll(): array {
		$sql = "SELECT * FROM artigos";
		$stmt = $this->conexao->query($sql);
		return $stmt->fetchAll(PDO::FETCH_CLASS, Artigo::class);
	}

}