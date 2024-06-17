document.addEventListener('DOMContentLoaded', () => {
  const linksExcluir = document.querySelectorAll('.linkExcluir') as NodeListOf<HTMLAnchorElement>;
  linksExcluir.forEach((link) => {
    link.addEventListener('click', (event) => {
      event.preventDefault(); // Evita o comportamento padrão do link
      if (confirm('Você realmente deseja excluir?')) {
        window.location.href = link.href; // Redireciona para o link se o usuário confirmar
      }
    });
  });
});
