
document.addEventListener('mouseover', (event) => {
const link = event.target.closest('a[href*="?"]');
if (link && !link.href.includes('accounts')) {
    quicklink.prefetch(link.href);
}
});