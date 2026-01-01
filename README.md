# Job Pulse 🚀

<p align="center">
  <img src="https://i.ibb.co/Z6jzPFpL/logogds.png" width="400" alt="Laravel Logo">
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 11">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2+">
  <img src="https://img.shields.io/badge/AI_Engine-Groq_Llama3-black?style=for-the-badge&logo=openai&logoColor=white" alt="AI Engine">
  <img src="https://img.shields.io/badge/Vector_DB-Pinecone-000000?style=for-the-badge&logo=pinecone&logoColor=white" alt="Vector DB">
  <img src="https://img.shields.io/badge/Frontend-Tailwind_v4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind">
  <img src="https://img.shields.io/badge/Performance-Optimized-brightgreen?style=for-the-badge" alt="Performance">
  <img src="https://img.shields.io/badge/License-MIT-blue?style=for-the-badge" alt="MIT License">
</p>

<p align="center">
  <strong>Not just a CRUD app—an AI-augmented recruiting platform with enterprise-grade performance.</strong>
</p>

---

## 🌟 Why Job Pulse?

Job Pulse combines modern Laravel development with cutting-edge AI features to solve real recruiting problems. While traditional job boards fail on searches like "creative coding jobs" (returning 0 results), Job Pulse's **Pixel AI** understands that you're looking for WebGL, Canvas, or Three.js expertise.

### 🎯 Real-World Examples

| You Search For | Traditional Board | Job Pulse |
|----------------|-------------------|-----------|
| "creative coding jobs" | ❌ 0 results | ✅ Finds WebGL, Canvas, Three.js roles |
| "work from anywhere" | ❌ Only matches "remote" | ✅ Understands distributed, async, location-independent |
| "roles for problem solvers" | ❌ No keyword match | ✅ Finds algorithmic, optimization, debugging roles |
| "highest paying Laravel jobs" | ❌ Text search only | ✅ Smart SQL sorting by salary value |

---

## ✨ Key Features

<table>
<tr>
<td width="50%">

### 🤖 AI-Powered Intelligence
- **Pixel AI Assistant** with natural language understanding
- **RAG Pipeline** using Groq, Gemini & Pinecone
- **Intelligent Query Routing** (3-layer architecture)
- **Vector Search** for semantic job matching
- **Zero-cost responses** for 90% of queries

</td>
<td width="50%">

### 💼 Employer Dashboard
- **Full CRUD** job management system
- **Company branding** with logo uploads
- **Smart search** across jobs, tags, and employers
- **Tag analytics** with usage tracking
- **Policy-based security** (only edit your jobs)

</td>
</tr>
<tr>
<td width="50%">

### ⚡ Performance Engineering
- **Aggressive caching** (sub-200ms load times)
- **N+1 query prevention** with eager loading
- **Surgical cache invalidation** (only clear what changed)
- **Background job processing** with queues
- **Optimized database queries** (select only needed fields)

</td>
<td width="50%">

### 📊 Analytics & Insights
- **Salary histogram engine** with Chart.js
- **Dynamic data bucketing** (10k ranges)
- **Real-time metrics** tracking

</td>
</tr>
</table>

---

## 🧠 Feature Deep Dive: The AI Core

The standout feature of Job Pulse is **Pixel AI**, a context-aware recruiting assistant powered by a multi-layered architecture implemented in `app/Http/Controllers/ChatController.php` and `app/Services/VectorService.php`.

### Intelligent Query Routing: The "Brain"

Unlike basic chatbots that send every message to an expensive LLM, Pixel AI uses a **three-layer decision tree**:

```
User Query → Layer 0 (Reflex) → Layer 1 (Router) → Layer 2 (Execution)
                  ↓                    ↓                    ↓
            Instant Reply        Intent Analysis     SQL or Vector Search
            (0ms, $0)           (Groq Llama 3)       (Database or RAG)
```

#### **Layer 0: Local Reflex Engine** 
A regex-based pattern matcher handles simple interactions instantly:
- Greetings: *"Hi"*, *"Hello"* → Pre-written friendly response
- Help requests: *"Help"*, *"What can you do?"* → Feature list
- Gratitude: *"Thanks"*, *"Thank you"* → Acknowledgment

**Performance:** 0ms latency, $0 cost, handles ~40% of queries

#### **Layer 1: LLM Router (Groq Llama 3)**
For real questions, the router analyzes intent with a specialized system prompt:

```
"Analyze this job search query:
- If asking for salary sorting → return 'SQL_SALARY'
- If asking for recent jobs → return 'SQL_RECENT'
- If asking about skills/context → return 'VECTOR_SEARCH'"
```

**Performance:** ~100-200ms, minimal token usage, handles ~50% of queries

#### **Layer 2: Execution Paths**

**SQL Path** - Direct database operations:
```php
// For "highest paying jobs"
Job::orderByRaw('CAST(salary AS UNSIGNED) DESC')
    ->with('employer', 'tags')
    ->limit(5)
    ->get();
```

**Vector Path** - RAG Pipeline for semantic queries:
1. **Embedding Generation:** User query → Google Gemini → 768-dimensional vector
2. **Semantic Search:** Vector → Pinecone similarity search → Top 5 job IDs
3. **Context Retrieval:** IDs → Database → Full job descriptions
4. **Synthesis:** Jobs + Original Query → Groq → Natural language response

**Performance:** ~1-2s for vector search, ~10% of queries, highest value queries

---

## 📊 Feature Deep Dive: Analytics Engine

### Salary Histogram Visualization

Implemented in `ChartsController.php`, this feature provides market insights through intelligent data processing.

#### Data Pipeline:
1. **Data Cleaning:**
   ```php
   // Strip currency symbols and formatting
   $cleanSalary = preg_replace('/[^0-9.]/', '', $salary);
   ```

2. **PHP-Side Calculations:**
   ```php
   $statistics = [
       'average' => $salaries->avg(),
       'min' => $salaries->min(),
       'max' => $salaries->max()
   ];
   ```

3. **Dynamic Bucketing:**
   - Automatically groups salaries into 10,000 EGP ranges
   - Example: 10k-20k, 20k-30k, 30k-40k
   - Generates clean JSON for Chart.js frontend

4. **Visualization:** Real-time histogram rendering showing salary distribution

---

## 🛠 Feature Deep Dive: Employer Tools

### Advanced Search System

Implemented in `SearchController.php` with multi-dimensional querying:

```php
Job::where(function($query) use ($searchTerm) {
    $query->where('title', 'LIKE', "%{$searchTerm}%")
          ->orWhere('description', 'LIKE', "%{$searchTerm}%")
          ->orWhere('location', 'LIKE', "%{$searchTerm}%")
          ->orWhereHas('tags', function($q) use ($searchTerm) {
              $q->where('name', 'LIKE', "%{$searchTerm}%");
          });
})
->with(['tags', 'employer']) // Prevent N+1 queries
->paginate(20);
```

**Performance:** Single SQL query instead of 21+ without eager loading

### Employer Dashboard

Built with `EmployerController.php` and `Dashboard.php`:

#### Features:
- **Live Company Search:** AJAX-enabled endpoint for instant company filtering
- **Optimized Selects:** Only load necessary fields (`id`, `name`, `logo`)
  ```php
  Employer::select('id', 'name', 'logo')
      ->where('name', 'LIKE', "%{$search}%")
      ->get();
  ```
- **Memory Efficiency:** Excludes heavy `bio` text from listing pages
- **Policy Gates:** `JobPolicy` ensures strict ownership validation
  ```php
  // Only owners can edit
  Gate::authorize('update', $job);
  ```

### Job Management (CRUD)

Comprehensive validation and security:

```php
$validated = $request->validate([
    'title' => 'required|max:255',
    'salary' => 'required',
    'closing_date' => 'required|date|after:posted_date',
    'logo' => 'nullable|image|max:2048'
]);
```

**File Handling:** Secure logo uploads to `storage/public/logos` with automatic linking

**Smart Cache Invalidation:**
```php
// Only clear affected caches
Cache::forget("job_{$id}");
Cache::forget("employer_{$employerId}_jobs");
// Featured jobs cache remains intact
```

---

## ⚡ Performance Engineering

### Caching Strategy

Job Pulse implements **multi-tiered caching** for production-grade performance:

#### 1. **Query Result Caching**
```php
// Featured jobs cached for 1 hour
$featured = Cache::remember('jobs.featured', 3600, function() {
    return Job::with('employer', 'tags')
        ->where('featured', true)
        ->get();
});

// Individual job pages cached by ID
$job = Cache::remember("job_{$id}", 3600, function() use ($id) {
    return Job::with('employer', 'tags')->findOrFail($id);
});
```

#### 2. **Eager Loading to Prevent N+1**
```php
// ❌ BAD: 101 queries (1 + 100 N+1)
foreach(Job::all() as $job) {
    echo $job->employer->name;
}

// ✅ GOOD: 2 queries total
foreach(Job::with('employer', 'tags')->get() as $job) {
    echo $job->employer->name;
}
```

### Background Job Processing

Email notifications and heavy tasks run asynchronously:

```php
// Don't wait for SMTP server
Mail::to($user)->queue(new JobPostedNotification($job));

// User sees instant confirmation, email sends in background
```

**Queue Configuration:**
- Driver: `database` (no Redis dependency for basic setup)
- Worker: `php artisan queue:work`
- Prevents UI freezing during email delivery

### Performance Metrics

| Metric | Without Optimization | With Optimization |
|--------|---------------------|-------------------|
| **Home Page Load** | ~3-5s | **~2-3s** |
| **Search Results** | ~2-3s | **~1-2s** |
| **Job Details** | ~1-2s | **~1-1.5s** |
| **AI Response Time** | ~1.5-2.5s | **~0-2s** |

---

## 🏗️ System Architecture

### Unified Hosting Architecture

**The Mistake:** Initially split App Server and Database Server across different cloud providers to use free tiers.

**The Impact:**
- Every SQL query crossed the internet
- Page loads: **3-5 seconds**
- 10 queries per page = 10 network round trips
- Unacceptable user experience

**The Solution:** Co-located application and database on the same provider/network.

**The Result:**
- Page loads: **~2s**
- Local network communication (no internet traversal)

**Key Takeaway:** Never separate your application from its database in production. Network latency is your enemy.

### Tech Stack

| Layer | Technology | Purpose |
|-------|-----------|---------|
| **Backend** | Laravel 11, PHP 8.2+ | Core MVC framework |
| **Database** | MySQL 8.0+ | Relational data storage |
| **Frontend** | Blade, Tailwind CSS v4, Alpine.js | Server-side rendering with reactive components |
| **AI Router** | Groq (Llama 3) | Intent detection & response generation |
| **Embeddings** | Google Gemini | 768-dimensional vector generation |
| **Vector DB** | Pinecone | Semantic similarity search |
| **Cache** | Redis/File | Performance optimization layer |
| **Queue** | Database Driver | Background job processing |
| **Charts** | Chart.js | Data visualization |

---

## 🚀 Getting Started

### Prerequisites

```bash
PHP >= 8.2
Composer
Node.js & NPM >= 18
MySQL >= 8.0
```

### Required API Keys (Free Tiers Available)

Sign up at:
- [Groq Console](https://console.groq.com/) - AI routing & generation
- [Google AI Studio](https://makersuite.google.com/) - Gemini embeddings
- [Pinecone](https://www.pinecone.io/) - Vector database

### Installation Steps

#### 1. Clone & Install Dependencies

```bash
git clone https://github.com/AboNady/Job_Pulse.git
cd Job_Pulse
composer install
npm install && npm run build
```

#### 2. Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

#### 3. Configure `.env` File

```env
# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=job_pulse
DB_USERNAME=your_username
DB_PASSWORD=your_password

# AI Services
GROQ_API_KEY=gsk_xxxxxxxxxxxxx
GEMINI_API_KEY=AIzaSyxxxxxxxxxx
PINECONE_API_KEY=xxxxxxxxxxxxx
PINECONE_HOST=https://your-index.pinecone.io

# Caching (File by default, Redis for production)
CACHE_DRIVER=file
QUEUE_CONNECTION=database

# Mail (for notifications)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
```

#### 4. Database Setup

```bash
php artisan migrate --seed
```

#### 5. Hydrate the Vector Database

The AI needs data to work. Run this custom command:

```bash
php artisan index:jobs
```

> **Note:** Processes jobs in batches of 50 to prevent memory leaks. For 1000+ jobs, this may take several minutes.

#### 6. Start Queue Worker (Optional but Recommended)

```bash
php artisan queue:work
```

Keep this running in a separate terminal for background jobs.

#### 7. Start Development Server

```bash
php artisan serve
```

Visit `http://localhost:8000` 🎉

---

### Vector Search Tuning

Adjust similarity threshold in `app/Services/VectorService.php`:

```php
'threshold' => 0.75  // Default
// Higher (0.8-0.9) = Stricter matches, fewer results
// Lower (0.5-0.7) = Broader matches, more results
```

---

## 🛣️ Roadmap & Future Features

- [ ] **Resume Parsing** - Upload CV for automatic job matching
- [ ] **Advanced Analytics** - Employer insights (views, applications, conversion rates)
- [ ] **Multi-language Support** - Arabic, French, German
- [ ] **Mobile App** - Mobile apps
- [ ] **Video Introductions** - Employer video uploads
- [ ] **Salary Negotiation Tool** - Market rate recommendations

---

## 🤝 Contributing

Contributions are welcome! Whether you're fixing bugs, adding features, or improving documentation.

### How to Contribute

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

### Development Guidelines

- Follow PSR-12 coding standards
- Write tests for new features (PHPUnit)
- Update documentation as needed
- Keep commits atomic and descriptive
- Comment complex logic in controllers

## 📄 License

This project is open-source software licensed under the [MIT License](LICENSE).

You are free to use, modify, and distribute this software for personal purposes.

---

## 🙏 Acknowledgments

- **Jeffrey Way & Laracasts** - Foundation curriculum and Laravel best practices
- **Gemini, ChatGPT and Claude** - Super helpful tools
- **Groq** - Lightning-fast LLM inference (Llama 3)
- **Pinecone** - Scalable vector database infrastructure
- **Google** - Gemini embedding models
- **Tailwind Labs** - Modern CSS framework

---

## 🔗 Links & Resources

- **🚀 Live Demo:** [View Job Pulse](https://jobpulse.rf.gd/)
- **📂 Source Code:** [GitHub Repository](https://github.com/AboNady/Job_Pulse)
- **🐛 Bug Tracking:** [Submit an Issue](https://github.com/AboNady/Job_Pulse/issues)
- **💼 Connect:** [Mahmoud Nady on LinkedIn](https://www.linkedin.com/in/abonady/)
  
---

## 📈 Project Stats

<p align="left">
  <img src="https://img.shields.io/github/stars/AboNady/Job_Pulse?style=for-the-badge&logo=github&color=yellow" alt="Stars">
  <img src="https://img.shields.io/github/forks/AboNady/Job_Pulse?style=for-the-badge&logo=github&color=orange" alt="Forks">
  <img src="https://img.shields.io/github/issues/AboNady/Job_Pulse?style=for-the-badge&logo=github&color=red" alt="Issues">
</p>

---

<p align="center">
  <strong>Built with ❤️, Laravel, and AI by <a href="https://github.com/AboNady">AboNady</a></strong><br>
  <sub>If this project helped you, consider giving it a ⭐</sub>
</p>
