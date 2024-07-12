import tkinter as tk
from tkinter import messagebox, simpledialog
import requests
import json
import re

# URL du service SOAP
url = 'http://localhost/NEWS_AL/Service/user/Soap-server.php'

# En-têtes pour les requêtes SOAP
headers = {
    'Content-Type': 'text/xml; charset=utf-8'
}

def send_soap_request(action, body):
    """Envoie une requête SOAP et retourne la réponse."""
    headers['SOAPAction'] = action
    try:
        response = requests.post(url, data=body, headers=headers)
        if response.status_code == 200:
            return response.content.decode('utf-8')
        else:
            # messagebox.showerror("Erreur", f"Erreur HTTP {response.status_code}: {response.text}")
            return None
    except Exception as e:
        # messagebox.showerror("Erreur", f"Erreur lors de la requête SOAP: {str(e)}")
        return None

def authenticate_user(email, password):
    """Authentifie l'utilisateur et retourne les informations s'il est valide."""
    body = f"""
    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://localhost/NEWS_AL/Service/user">
       <soapenv:Header/>
       <soapenv:Body>
          <ser:authenticateUser>
             <email>{email}</email>
             <password>{password}</password>
          </ser:authenticateUser>
       </soapenv:Body>
    </soapenv:Envelope>
    """
    response = send_soap_request('authenticateUser', body)
    if response:
        match = re.search(r'<return[^>]*>(.*?)</return>', response)
        if match:
            result = match.group(1)
            user_info = json.loads(result)
            return user_info
    return None

def list_users(token):
    """Liste les utilisateurs."""
    body = f"""
    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://localhost/NEWS_AL/Service/user">
       <soapenv:Header/>
       <soapenv:Body>
          <ser:listUsers>
             <token>{token}</token>
          </ser:listUsers>
       </soapenv:Body>
    </soapenv:Envelope>
    """
    response = send_soap_request('listUsers', body)
    if response:
        match = re.search(r'<return[^>]*>(.*?)</return>', response)
        if match:
            json_content = match.group(1)
            return json.loads(json_content)
    return None

def get_user_info(token, email):
    """Récupère les informations d'un utilisateur spécifique."""
    body = f"""
    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://localhost/NEWS_AL/Service/user">
       <soapenv:Header/>
       <soapenv:Body>
          <ser:getUserInfo>
             <token>{token}</token>
             <email>{email}</email>
          </ser:getUserInfo>
       </soapenv:Body>
    </soapenv:Envelope>
    """
    response = send_soap_request('getUserInfo', body)
    if response:
        match = re.search(r'<return[^>]*>(.*?)</return>', response)
        if match:
            json_content = match.group(1)
            return json.loads(json_content)
    return None

def add_user(token, nom, email, mot_de_passe, role_):
    """Ajoute un utilisateur."""
    body = f"""
    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://localhost/NEWS_AL/Service/user">
       <soapenv:Header/>
       <soapenv:Body>
          <ser:addUser>
             <token>{token}</token>
             <nom>{nom}</nom>
             <email>{email}</email>
             <mot_de_passe>{mot_de_passe}</mot_de_passe>
             <role>{role_}</role>
          </ser:addUser>
       </soapenv:Body>
    </soapenv:Envelope>
    """
    response = send_soap_request('addUser', body)
    if response:
        match = re.search(r'<return[^>]*>(.*?)</return>', response)
        if match:
            result = match.group(1)
            if "successfully" in result:
                messagebox.showinfo("Succès", "Utilisateur ajouté avec succès")
            else:
                messagebox.showerror("Erreur", "Erreur lors de l'ajout de l'utilisateur")
        else:
            messagebox.showerror("Erreur", "Erreur lors de la requête SOAP")
    else:
        messagebox.showerror("Erreur", "Erreur lors de la requête SOAP")

def delete_user(token, user_email):
    """Supprime un utilisateur."""
    body = f"""
    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://localhost/NEWS_AL/Service/user">
       <soapenv:Header/>
       <soapenv:Body>
          <ser:deleteUser>
             <token>{token}</token>
             <email>{user_email}</email>
          </ser:deleteUser>
       </soapenv:Body>
    </soapenv:Envelope>
    """
    response = send_soap_request('deleteUser', body)
    if response:
        match = re.search(r'<return[^>]*>(.*?)</return>', response)
        if match:
            result = match.group(1)
            if "successfully" in result:
                messagebox.showinfo("Succès", "Utilisateur supprimé avec succès")
            else:
                messagebox.showerror("Erreur", "Erreur lors de la suppression de l'utilisateur")
        else:
            messagebox.showerror("Erreur", "Erreur lors de la requête SOAP")
    else:
        messagebox.showerror("Erreur", "Erreur lors de la requête SOAP")

def update_user(token, email, nom, new_email, mot_de_passe, role_):
    """Met à jour un utilisateur."""
    # Si le mot de passe est vide, le mettre à 'null'
    mot_de_passe = mot_de_passe if mot_de_passe else 'null'
    
    body = f"""
    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://localhost/NEWS_AL/Service/user">
       <soapenv:Header/>
       <soapenv:Body>
          <ser:updateUser>
             <token>{token}</token>
             <email>{email}</email>
             <nom>{nom}</nom>
             <new_email>{new_email}</new_email>
             <mot_de_passe>{mot_de_passe}</mot_de_passe>
             <role>{role_}</role>
          </ser:updateUser>
       </soapenv:Body>
    </soapenv:Envelope>
    """
    response = send_soap_request('updateUser', body)
    if response:
        match = re.search(r'<return[^>]*>(.*?)</return>', response)
        if match:
            result = match.group(1)
            if "successfully" in result:
                messagebox.showinfo("Succès", "Utilisateur mis à jour avec succès")
            else:
                messagebox.showerror("Erreur", "Erreur lors de la mise à jour de l'utilisateur")
        else:
            messagebox.showerror("Erreur", "Erreur lors de la requête SOAP")
    else:
        messagebox.showerror("Erreur", "Erreur lors de la requête SOAP")

def login():
    """Demander les informations de connexion et authentifier l'utilisateur."""
    email = simpledialog.askstring("Login", "Entrez votre email:")
    password = simpledialog.askstring("Login", "Entrez votre mot de passe:", show='*')

    user_info = authenticate_user(email, password)
    if user_info:
        token = user_info.get('token')
        role = user_info.get('role')
        if role != 'administrateur':
            messagebox.showwarning("Avertissement", "Vous n'avez pas les droits nécessaires pour accéder à cette application.")
            return login()  # Redirige vers la connexion si l'utilisateur n'est pas un administrateur
        app(token, role)
    else:
        messagebox.showwarning("Avertissement", "Authentification échouée.")

def app(token, role):
    """Interface principale pour la gestion des utilisateurs."""
    def on_list_users():
        users = list_users(token)
        if users:
            users_str = "\n".join([f"ID: {user['id']}, Nom: {user['nom']}, Email: {user['email']}, Role: {user['role']}" for user in users])
            messagebox.showinfo("Liste des utilisateurs", users_str)
        else:
            messagebox.showinfo("Liste des utilisateurs", "Aucun utilisateur trouvé.")

    def on_add_user():
        nom = simpledialog.askstring("Ajouter un utilisateur", "Nom:")
        email = simpledialog.askstring("Ajouter un utilisateur", "Email:")
        mot_de_passe = simpledialog.askstring("Ajouter un utilisateur", "Mot de passe:", show='*')
        role_ = simpledialog.askstring("Ajouter un utilisateur", "Rôle:")
        add_user(token, nom, email, mot_de_passe, role_)

    def on_delete_user():
        user_email = simpledialog.askstring("Supprimer un utilisateur", "Email de l'utilisateur:")
        delete_user(token, user_email)

    def on_update_user():
        email = simpledialog.askstring("Modifier un utilisateur", "Email de l'utilisateur à modifier :")
        user_info = get_user_info(token, email)
        if user_info:
            # Pré-remplir les champs avec les informations existantes
            nom = simpledialog.askstring("Modifier un utilisateur", "Nom:", initialvalue=user_info.get('nom'))
            new_email = simpledialog.askstring("Modifier un utilisateur", "Email:", initialvalue=email)
            mot_de_passe = simpledialog.askstring("Modifier un utilisateur", "Mot de passe:", show='*')
            role_ = simpledialog.askstring("Modifier un utilisateur", "Rôle:", initialvalue=user_info.get('role'))
            update_user(token, email, nom, new_email, mot_de_passe, role_)
        else:
            messagebox.showwarning("Erreur", "Utilisateur non trouvé.")

    window = tk.Tk()
    window.title("Gestion des utilisateurs")

    tk.Button(window, text="Lister les utilisateurs", command=on_list_users).pack(pady=10)
    tk.Button(window, text="Ajouter un utilisateur", command=on_add_user).pack(pady=10)
    tk.Button(window, text="Supprimer un utilisateur", command=on_delete_user).pack(pady=10)
    tk.Button(window, text="Modifier un utilisateur", command=on_update_user).pack(pady=10)

    window.mainloop()

if __name__ == '__main__':
    login()
