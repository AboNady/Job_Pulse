export default function chatWidget(config) {
    return {
        endpoint: config.endpoint,
        csrf: config.csrf,

        isOpen: false,
        isLoading: false,
        currentQuestion: '',
        messages: [],
        error: '',

        init() {
            const saved = localStorage.getItem('pixel_chat_history');

            if (saved) {
                try {
                    this.messages = JSON.parse(saved);
                } catch (e) {
                    console.error('Failed to parse chat history', e);
                }
            }

            this.$watch('messages', value => {
                localStorage.setItem(
                    'pixel_chat_history',
                    JSON.stringify(value)
                );
            });
        },

        parseMessage(content) {
            if (typeof marked === 'undefined') return content;
            marked.setOptions({ breaks: true, gfm: true });
            return marked.parse(content);
        },

        toggleChat() {
            this.isOpen = !this.isOpen;
            if (this.isOpen) this.focusAndScroll();
        },

        clearChat() {
            this.messages = [];
            localStorage.removeItem('pixel_chat_history');
        },

        scrollToBottom() {
            const container = this.$refs.scrollContainer;
            if (!container) return;

            this.$nextTick(() => {
                container.scrollTop = container.scrollHeight;
            });
        },

        focusAndScroll() {
            this.$nextTick(() => {
                this.scrollToBottom();
                this.$refs.inputField?.focus();
            });
        },

        async sendMessage() {
            const question = this.currentQuestion.trim();
            if (!question) return;

            this.error = '';
            this.messages.push({ type: 'user', content: question });
            this.currentQuestion = '';
            this.isLoading = true;

            this.scrollToBottom();

            try {
                const response = await fetch(this.endpoint, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': this.csrf
                    },
                    body: JSON.stringify({ question })
                });

                if (!response.ok) {
                    throw new Error('Request failed');
                }

                const data = await response.json();

                this.messages.push({
                    type: 'ai',
                    content: data.answer ?? "I couldn't process that.",
                    duration: data.duration
                });

            } catch (err) {
                console.error(err);
                this.error = 'Connection failed.';
            } finally {
                this.isLoading = false;
                this.focusAndScroll();
            }
        }
    };
}
