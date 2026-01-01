// We use a standard function name to match your Chat Widget style
export default function companySearch() {
    return {
        query: new URLSearchParams(window.location.search).get('q') || '',
        isLoading: false,

        init() {
            // Optional initialization logic
        },

        async performSearch() {
            this.isLoading = true;

            const url = new URL(window.location.href);
            if (this.query) {
                url.searchParams.set('q', this.query);
            } else {
                url.searchParams.delete('q');
            }
            window.history.pushState({}, '', url);

            try {
                const response = await fetch(url);
                const html = await response.text();
                
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newContent = doc.getElementById('results-container').innerHTML;

                document.getElementById('results-container').innerHTML = newContent;

            } catch (error) {
                console.error('Search failed:', error);
            } finally {
                this.isLoading = false;
            }
        }
    }; 
}