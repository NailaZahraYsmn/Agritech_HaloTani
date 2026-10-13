<style>
    /* ===== Brand ===== */
    .agri-brand { display: flex; align-items: center; gap: .75rem; }
    .agri-brand-icon {
        display: inline-flex; align-items: center; justify-content: center;
        width: 2.5rem; height: 2.5rem; border-radius: .75rem;
        background: #2E7D32; color: #fff; flex-shrink: 0;
    }
    .agri-brand-text { font-size: 1.05rem; font-weight: 700; color: #111827; }

    /* ===== Sidebar container ===== */
    .fi-sidebar { background: #fff; }
    .fi-sidebar-header { padding-inline: 1rem; }
    .fi-sidebar-nav { padding: 1rem .75rem; }
    .fi-sidebar-nav-groups { gap: .25rem; }
    .fi-sidebar-group-items { gap: .25rem; }

    /* ===== Menu items ===== */
    .fi-sidebar-item-btn {
        border-radius: .75rem;
        padding: .7rem .85rem;
        gap: .75rem;
        transition: background-color .15s ease;
    }
    .fi-sidebar-item-btn .fi-sidebar-item-label {
        font-size: .875rem; font-weight: 500; color: #4b5563;
    }
    .fi-sidebar-item-btn .fi-icon { color: #6b7280; }
    .fi-sidebar-item:not(.fi-active) .fi-sidebar-item-btn:hover { background: #f3f4f6; }

    .fi-sidebar-item.fi-active > .fi-sidebar-item-btn { background: #e8f5e9; }
    .fi-sidebar-item.fi-active > .fi-sidebar-item-btn .fi-sidebar-item-label { color: #2E7D32; font-weight: 600; }
    .fi-sidebar-item.fi-active > .fi-sidebar-item-btn .fi-icon { color: #2E7D32; }

    /* ===== Footer (kartu user + logout) ===== */
    .agri-sidebar-footer {
        padding: .75rem; display: flex; flex-direction: column; gap: .5rem;
    }
    .agri-user-card {
        display: flex; align-items: center; gap: .75rem;
        padding: .65rem .75rem; border-radius: .75rem;
        background: #f9fafb; border: 1px solid #f0f1f3;
        text-decoration: none;
    }
    .agri-user-card:hover { background: #f3f4f6; }
    .agri-user-avatar {
        display: inline-flex; align-items: center; justify-content: center;
        width: 2.25rem; height: 2.25rem; border-radius: 9999px;
        background: #e8f5e9; border: 1px solid #c8e6c9; flex-shrink: 0;
    }
    .agri-user-avatar-icon { width: 1.1rem; height: 1.1rem; color: #2E7D32; }
    .agri-user-info { display: flex; flex-direction: column; min-width: 0; line-height: 1.25; }
    .agri-user-name {
        font-size: .8rem; font-weight: 600; color: #111827;
        overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
    }
    .agri-user-role { font-size: .72rem; color: #6b7280; }

    .agri-logout {
        display: flex; align-items: center; gap: .75rem; width: 100%;
        padding: .65rem .75rem; border-radius: .75rem;
        font-size: .875rem; font-weight: 500; color: #ef4444;
        background: transparent; border: 0; cursor: pointer; text-align: left;
        transition: background-color .15s ease;
    }
    .agri-logout:hover { background: #fef2f2; }
    .agri-logout-icon { width: 1.25rem; height: 1.25rem; }
</style>