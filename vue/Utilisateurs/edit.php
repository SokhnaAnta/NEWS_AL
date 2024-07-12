<!DOCTYPE html>
<html>
<head>
    <title>Modifier un utilisateur</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Modifier un utilisateur</h2>
    <form action="index.php?action=edit_utilisateur&id=<?php echo $utilisateur->id; ?>" method="POST">
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $utilisateur->nom; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $utilisateur->email; ?>" required>
        </div>
        <div class="form-group">
            <label for="role">Rôle</label>
            <select class="form-control" id="role" name="role" required>
                <option value="editeur" <?php if ($utilisateur->role == 'editeur') echo 'selected'; ?>>Éditeur</option>
                <option value="administrateur" <?php if ($utilisateur->role == 'administrateur') echo 'selected'; ?>>Administrateur</option>
            </select>
        </div>
        <div class="form-group">
            <label for="mot_de_passe">Mot de passe</label>
            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe">
            <small class="form-text text-muted">Laissez vide si vous ne souhaitez pas changer le mot de passe.</small>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="generer_token" name="generer_token">
            <label class="form-check-label" for="generer_token">Générer un nouveau token</label>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
</body>
</html>
