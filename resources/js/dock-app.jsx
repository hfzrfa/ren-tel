'use client';

import React from 'react';
import { createRoot } from 'react-dom/client';
import Dock from './components/Dock.jsx';

function HomeIcon(props) {
  return (
    <svg viewBox="0 0 24 24" fill="currentColor" className="h-6 w-6 text-white" aria-hidden="true" {...props}>
      <path d="M12 3l9 8h-3v9h-5v-6H11v6H6v-9H3l9-8z" />
    </svg>
  );
}

function CarIcon(props) {
  return (
    <svg viewBox="0 0 24 24" fill="currentColor" className="h-6 w-6 text-white" aria-hidden="true" {...props}>
      <path d="M5 11l1-3a3 3 0 012.83-2h6.34A3 3 0 0118 8l1 3h1a1 1 0 110 2h-1v4a1 1 0 11-2 0v-1H8v1a1 1 0 11-2 0v-4H5a1 1 0 110-2h0zM7 16h10v-3H7v3zm1.5-8a1.5 1.5 0 100 3h7a1.5 1.5 0 100-3h-7z" />
    </svg>
  );
}

function UserIcon(props) {
  return (
    <svg viewBox="0 0 24 24" fill="currentColor" className="h-6 w-6 text-white" aria-hidden="true" {...props}>
      <path d="M12 12a5 5 0 100-10 5 5 0 000 10zm-7 9a7 7 0 1114 0H5z" />
    </svg>
  );
}

function LogoutIcon(props) {
  return (
    <svg viewBox="0 0 24 24" fill="currentColor" className="h-6 w-6 text-white" aria-hidden="true" {...props}>
      <path d="M16 17l5-5-5-5v3H9v4h7v3zM4 4h8a1 1 0 110 2H6v12h6a1 1 0 110 2H4a1 1 0 01-1-1V5a1 1 0 011-1z" />
    </svg>
  );
}

function mountDock() {
  const el = document.getElementById('react-dock');
  if (!el) return;

  // Read routes from data-* if provided on a page; fallback to common defaults
  const home = el.dataset.home || '/';
  const book = el.dataset.book || '/book';
  const profile = el.dataset.profile || '/login';

  const items = [
    {
      icon: <HomeIcon />, label: 'Home', onClick: () => (window.location.href = home),
    },
    {
      icon: <CarIcon />, label: 'Book', onClick: () => (window.location.href = book),
    },
    {
      icon: <UserIcon />, label: 'Profile', onClick: () => (window.location.href = profile),
    },
    {
      icon: <LogoutIcon />, label: 'Logout', onClick: () => {
        const form = document.getElementById('logout-form');
        if (form) form.submit();
        else window.location.href = home;
      },
    },
  ];

  const root = createRoot(el);
  // Show only on mobile (hidden on md and above) and move slightly up from bottom
  root.render(<Dock items={items} className="md:hidden" offsetBottom={24} />);
}

document.addEventListener('DOMContentLoaded', mountDock);
