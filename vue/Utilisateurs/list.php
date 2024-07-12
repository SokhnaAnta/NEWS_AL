<!DOCTYPE html>
<html>
<head>
    <title>Liste des utilisateurs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        .add-card {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
        }
        .add-card a {
            color: #007bff; /* Blue color for the icon */
            font-size: 2rem;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row">
     
        <?php foreach ($utilisateurs as $utilisateur): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-user"></i>
                            <?php echo htmlspecialchars($utilisateur->nom); ?>
                        </h5>
                        <p class="card-text">
                            <strong>Email: </strong><?php echo htmlspecialchars($utilisateur->email); ?><br>
                            <strong>Rôle: </strong><?php echo htmlspecialchars($utilisateur->role); ?><br>
                            <?php if ($utilisateur->token != ''): ?>
                               <i class="fas fa-key"></i> <?php echo htmlspecialchars($utilisateur->token); ?><br>
                            <?php endif; ?>                        </p>
                        <div class="d-flex justify-content-between">
                            <a href="index.php?action=edit_utilisateur&id=<?php echo $utilisateur->id; ?>" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                          <a href="index.php?action=delete_utilisateur&id=<?php echo $utilisateur->id; ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                <i class="fas fa-trash"></i> Supprimer
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="col-md-4">
            <div class="card mb-4 add-card">
                <a href="index.php?action=add_utilisateur">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
