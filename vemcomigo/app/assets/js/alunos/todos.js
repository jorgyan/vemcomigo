document.addEventListener('DOMContentLoaded', function() {
      const linksExcluir = document.querySelectorAll('.linkExcluir');
      linksExcluir.forEach(function(link) {
        link.addEventListener('click', function(event) {
          event.preventDefault(); // Evita o comportamento padrão do link
          if (confirm('Você realmente deseja excluir?')) {
            window.location.href = this.href; // Redireciona para o link se o usuário confirmar
          }
        });
      });
    });