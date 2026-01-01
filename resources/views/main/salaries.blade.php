<x-layout>
    {{-- Ambient Background Glow --}}
    <div class="fixed top-20 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-blue-600/20 rounded-full blur-[120px] -z-10 pointer-events-none"></div>

    <div class="px-6 sm:px-10 lg:px-0 max-w-6xl mx-auto py-16 space-y-12">
        
        <div class="text-center space-y-4 max-w-2xl mx-auto">
            <h1 class="text-5xl font-bold text-white tracking-tight">
                Salary Insights
            </h1>
            <p class="text-slate-400 text-lg">
                Real-time compensation data across all job categories.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            {{-- Card 1: Average (Blue) --}}
            <div class="group relative overflow-hidden bg-gradient-to-br from-slate-800/40 to-slate-900/40 backdrop-blur-sm border border-slate-700/50 rounded-2xl p-6 transition-all duration-300 hover:border-blue-500/50 hover:shadow-lg hover:shadow-blue-900/20">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="w-24 h-24 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="p-2 bg-blue-500/10 rounded-lg border border-blue-500/20 group-hover:border-blue-500/40 transition-colors">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                        </div>
                        <p class="text-slate-400 text-sm font-medium">Market Average</p>
                    </div>
                    <p class="text-4xl font-bold text-white tracking-tight" id="avgSalary">--</p>
                    <p class="text-blue-400/60 text-xs mt-2 font-medium">Base compensation per year</p>
                </div>
            </div>

            {{-- Card 2: Highest (Emerald) --}}
            <div class="group relative overflow-hidden bg-gradient-to-br from-slate-800/40 to-slate-900/40 backdrop-blur-sm border border-slate-700/50 rounded-2xl p-6 transition-all duration-300 hover:border-emerald-500/50 hover:shadow-lg hover:shadow-emerald-900/20">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="w-24 h-24 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                </div>
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="p-2 bg-emerald-500/10 rounded-lg border border-emerald-500/20 group-hover:border-emerald-500/40 transition-colors">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                        </div>
                        <p class="text-slate-400 text-sm font-medium">Highest Position</p>
                    </div>
                    <p class="text-4xl font-bold text-white tracking-tight" id="maxSalary">--</p>
                    <p class="text-emerald-400/60 text-xs mt-2 font-medium">Top tier compensation</p>
                </div>
            </div>

            {{-- Card 3: Lowest (Rose/Orange) --}}
            <div class="group relative overflow-hidden bg-gradient-to-br from-slate-800/40 to-slate-900/40 backdrop-blur-sm border border-slate-700/50 rounded-2xl p-6 transition-all duration-300 hover:border-rose-500/50 hover:shadow-lg hover:shadow-rose-900/20">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <svg class="w-24 h-24 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/></svg>
                </div>
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="p-2 bg-rose-500/10 rounded-lg border border-rose-500/20 group-hover:border-rose-500/40 transition-colors">
                            <svg class="w-5 h-5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                        </div>
                        <p class="text-slate-400 text-sm font-medium">Entry Level</p>
                    </div>
                    <p class="text-4xl font-bold text-white tracking-tight" id="minSalary">--</p>
                    <p class="text-rose-400/60 text-xs mt-2 font-medium">Starting compensation</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-b from-slate-800/40 to-slate-900/40 backdrop-blur-xl border border-slate-700/50 rounded-3xl p-1 shadow-2xl">
            {{-- Fake Browser/App Toolbar for aesthetic --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-700/50 bg-slate-800/30 rounded-t-[20px]">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-red-500/20 border border-red-500/50"></div>
                    <div class="w-3 h-3 rounded-full bg-yellow-500/20 border border-yellow-500/50"></div>
                    <div class="w-3 h-3 rounded-full bg-emerald-500/20 border border-emerald-500/50"></div>
                </div>
                <div class="text-xs font-mono text-slate-500">Market Distribution</div>
                <div class="flex gap-2">
                     <div class="w-20 h-2 bg-slate-700/30 rounded-full"></div>
                </div>
            </div>

            <div class="p-6 sm:p-8 h-[500px]">
                <canvas id="salaryChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Data passed from Laravel Controller
        const labels = @json($labels);
        const data = @json($data);
        
        // Stats are now passed directly from PHP (Accurate & Fast)
        const avg = @json($avgSalary);
        const max = @json($maxSalary);
        const min = @json($minSalary);

        // Formatter
        const formatMoney = (amount) => 'EGP ' + parseInt(amount).toLocaleString();

        document.getElementById('avgSalary').textContent = formatMoney(avg);
        document.getElementById('maxSalary').textContent = formatMoney(max);
        document.getElementById('minSalary').textContent = formatMoney(min);

        // Chart Configuration
        const ctx = document.getElementById('salaryChart').getContext('2d');
        
        // Custom Gradient
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(59, 130, 246, 0.6)'); // Blue 500 (Top)
        gradient.addColorStop(0.6, 'rgba(59, 130, 246, 0.1)'); // Mid
        gradient.addColorStop(1, 'rgba(59, 130, 246, 0.0)');   // Bottom (Transparent)

        Chart.defaults.color = '#94a3b8';
        Chart.defaults.font.family = 'Inter, sans-serif';

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Number of Jobs',
                    data: data,
                    backgroundColor: gradient,
                    borderColor: '#3b82f6',
                    borderWidth: 2,
                    borderRadius: 4,
                    borderSkipped: false,
                    // These two settings make the bars wide like a Histogram
                    barPercentage: 0.95, 
                    categoryPercentage: 0.95,
                    hoverBackgroundColor: '#60a5fa',
                    hoverShadow: '0 0 15px #3b82f6',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.9)',
                        backdropFilter: 'blur(8px)',
                        titleColor: '#f8fafc',
                        bodyColor: '#e2e8f0',
                        borderColor: 'rgba(51, 65, 85, 0.5)',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 12,
                        displayColors: false,
                        callbacks: {
                            title: (items) => `Range: ${items[0].label}`,
                            label: (context) => ` ${context.raw} Jobs found in this range`
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        border: { display: false },
                        grid: {
                            color: 'rgba(148, 163, 184, 0.05)', // Very subtle grid lines
                            drawTicks: false,
                        },
                        ticks: {
                            padding: 20,
                            callback: (value) => value + ' jobs' // Y-axis label
                        }
                    },
                    x: {
                        border: { display: false },
                        grid: { display: false },
                        ticks: { 
                            padding: 20,
                            maxRotation: 0,
                            autoSkip: true,
                            maxTicksLimit: 12 // Prevent overcrowding labels
                        }
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                }
            }
        });
    </script>
</x-layout>