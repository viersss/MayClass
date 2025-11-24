@extends('admin.layout')

@section('content')
<style>
/* Modern Content Management Styles */
:root {
    --primary: #0f766e;
    --primary-dark: #0d5d56;
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --bg-surface: #ffffff;
    --bg-body: #f8fafc;
    --text-main: #1e293b;
    --text-muted: #64748b;
    --border-color: #e2e8f0;
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --radius: 12px;
}

.ct-container {
    display: flex;
    flex-direction: column;
    gap: 32px;
    max-width: 1600px;
    margin: 0 auto;
}

/* Page Header - Match Finance Style */
.page-header {
    background: var(--bg-surface);
    padding: 24px 32px;
    border-radius: var(--radius);
    border: 1px solid var(--border-color);
    box-shadow: var(--shadow-sm);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-content h2 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-main);
    margin: 0 0 4px 0;
}

.header-content p {
    margin: 0;
    color: var(--text-muted);
    font-size: 0.9rem;
}

/* Tabs Container */
.ct-tabs {
    background: white;
    border-radius: var(--radius);
    border: 1px solid var(--border-color);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
}

.ct-tabs-nav {
    display: flex;
    border-bottom: 2px solid var(--border-color);
    background: #fafbfc;
    flex-wrap: wrap;
}

.ct-tab-btn {
    padding: 16px 24px;
    background: none;
    border: none;
    border-bottom: 3px solid transparent;
    color: var(--text-muted);
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    transition: all 0.2s;
}

.ct-tab-btn:hover {
    color: var(--primary);
    background: rgba(15, 118, 110, 0.05);
}

.ct-tab-btn.active {
    color: var(--primary);
    border-bottom-color: var(--primary);
    background: white;
}

.ct-tab-content {
    display: none;
    padding: 32px;
}

.ct-tab-content.active {
    display: block;
}

/* Buttons - NO EMOJIS */
.ct-btn {
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    border: none;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.ct-btn-primary {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(15, 118, 110, 0.3);
}

.ct-btn-primary:hover {
    transform: translateY(-2px);
}

.ct-btn-secondary {
    background: white;
    color: var(--text-main);
    border: 2px solid var(--border-color);
}

.ct-btn-secondary:hover {
    border-color: var(--primary);
    color: var(--primary);
}

.ct-btn-danger {
    background: var(--danger);
    color: white;
}

.ct-btn-sm {
    padding: 8px 16px;
    font-size: 13px;
}

/* Table */
.ct-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 24px;
}

.ct-table th {
    background: #f8f9fa;
    padding: 12px 16px;
    text-align: left;
    font-weight: 600;
    color: var(--text-main);
    border-bottom: 2px solid var(--border-color);
}

.ct-table td {
    padding: 12px 16px;
    border-bottom: 1px solid var(--border-color);
}

.ct-table tr:hover {
    background: #f9fafb;
}

/* Modal with BACKDROP BLUR like Tentor page */
.ct-modal-overlay {
    display: none;
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    bottom: 0 !important;
    background: rgba(0, 0, 0, 0.5) !important;
    backdrop-filter: blur(8px) !important;
    -webkit-backdrop-filter: blur(8px) !important;
    z-index: 999999 !important;
    padding: 20px;
}

.ct-modal-overlay.active {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
}

.ct-modal {
    position: relative !important;
    background: white !important;
    border-radius: 16px !important;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4) !important;
    width: 90% !important;
    max-width: 600px !important;
    max-height: 90vh !important;
    overflow: auto !important;
    opacity: 1 !important;
    visibility: visible !important;
    display: block !important;
    margin: 0 auto !important;
}

.ct-modal-header {
    padding: 24px 32px;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.ct-modal-header h3 {
    margin: 0;
    font-size: 20px;
    color: var(--text-main);
}

.ct-modal-close {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #f1f5f9;
    border: none;
    font-size: 20px;
    cursor: pointer;
    transition: all 0.2s;
}

.ct-modal-close:hover {
    background: var(--danger);
    color: white;
}

.ct-modal-body {
    padding: 32px;
    max-height: 60vh;
    overflow-y: auto;
}

.ct-modal-footer {
    padding: 20px 32px;
    border-top: 1px solid var(--border-color);
    display: flex;
    gap: 12px;
    justify-content: flex-end;
}

/* Forms */
.ct-form-group {
    margin-bottom: 24px;
}

.ct-form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: var(--text-main);
    font-size: 14px;
}

.ct-form-input,
.ct-form-textarea {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid var(--border-color);
    border-radius: 8px;
    font-size: 14px;
    color: var(--text-main);
    transition: all 0.2s;
}

.ct-form-input:focus,
.ct-form-textarea:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.1);
}

.ct-form-textarea {
    resize: vertical;
    min-height: 100px;
    font-family: inherit;
}

/* Alert */
.ct-alert {
    padding: 16px 20px;
    border-radius: 8px;
    margin-bottom: 24px;
}

.ct-alert-success {
    background: #d1fae5;
    color: #065f46;
    border-left: 4px solid var(--success);
}
</style>

<div class="ct-container">
    <!-- Page Header - Match Finance -->
    <div class="page-header">
        <div class="header-content">
            <h2>Manajemen Konten</h2>
            <p>Kelola konten landing page, artikel, dan informasi lainnya</p>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="ct-alert ct-alert-success">
        ✓ {{ session('success') }}
    </div>
    @endif

    <!-- Tabs -->
    <div class="ct-tabs">
        <div class="ct-tabs-nav">
            <button class="ct-tab-btn active" onclick="ctSwitchTab('hero')">Hero Section</button>
            <button class="ct-tab-btn" onclick="ctSwitchTab('articles')">Artikel</button>
            <button class="ct-tab-btn" onclick="ctSwitchTab('advantages')">Keunggulan</button>
            <button class="ct-tab-btn" onclick="ctSwitchTab('testimonials')">Testimoni</button>
            <button class="ct-tab-btn" onclick="ctSwitchTab('mentors')">Mentor</button>
            <button class="ct-tab-btn" onclick="ctSwitchTab('faqs')">FAQ</button>
        </div>

        <div id="hero-tab" class="ct-tab-content active">
            @include('admin.content.partials.hero')
        </div>
        <div id="articles-tab" class="ct-tab-content">
            @include('admin.content.partials.articles')
        </div>
        <div id="advantages-tab" class="ct-tab-content">
            @include('admin.content.partials.advantages')
        </div>
        <div id="testimonials-tab" class="ct-tab-content">
            @include('admin.content.partials.testimonials')
        </div>
        <div id="mentors-tab" class="ct-tab-content">
            @include('admin.content.partials.mentors')
        </div>
        <div id="faqs-tab" class="ct-tab-content">
            @include('admin.content.partials.faqs')
        </div>
    </div>
</div>

<script>
function ctSwitchTab(tab) {
    document.querySelectorAll('.ct-tab-content').forEach(el => el.classList.remove('active'));
    document.querySelectorAll('.ct-tab-btn').forEach(el => el.classList.remove('active'));
    document.getElementById(tab + '-tab').classList.add('active');
    event.target.classList.add('active');
}

function ctOpenModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.classList.add('active');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
}

function ctCloseModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.classList.remove('active');
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }
}

// ESC key
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') document.querySelectorAll('.ct-modal-overlay.active').forEach(m => ctCloseModal(m.id));
});

// Click overlay
document.addEventListener('click', e => {
    if (e.target.classList.contains('ct-modal-overlay')) ctCloseModal(e.target.id);
});

// Auto-hide alert
setTimeout(() => {
    const alert = document.querySelector('.ct-alert');
    if (alert) {
        alert.style.opacity = '0';
        alert.style.transition = 'opacity 0.3s';
        setTimeout(() => alert.remove(), 300);
    }
}, 5000);
</script>
@endsection