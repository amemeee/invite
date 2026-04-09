<!DOCTYPE html>
<html lang="en" data-bs-theme="dark"> <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Card Inventory Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            transition: background-color 0.3s ease;
        }

        /* Light Mode Specific Adjustments */
        [data-bs-theme="light"] body {
            background-color: #f8f9fa;
        }
        [data-bs-theme="light"] .table thead th {
            background-color: #f1f3f5;
            color: #495057;
        }

        /* Dark Mode Specific Adjustments */
        [data-bs-theme="dark"] body {
            background-color: #121212;
        }
        [data-bs-theme="dark"] .card {
            background-color: #1e1e1e;
            border: 1px solid #333;
        }

        .table img {
            object-fit: cover;
            border: 1px solid #dee2e6;
        }
        .card {
            border: none;
            border-radius: 12px;
        }
        .btn {
            border-radius: 8px;
            font-weight: 500;
        }
        .table thead th {
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
        }

        /* Theme Toggle Button Positioning */
        .theme-toggle-btn {
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 50px;
        }
    </style>
</head>
<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-11">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold mb-0">Card Collections</h2>
                        <p class="text-muted small">Manage your inventory and pricing here.</p>
                    </div>

                    <div class="d-flex gap-2">
                        <button id="themeToggle" class="btn btn-outline-secondary theme-toggle-btn">
                            <i id="themeIcon" class="bi bi-sun-fill"></i>
                        </button>

                        <a href="{{ route('cards.create') }}" class="btn btn-success px-4 shadow-sm">
                             + ADD NEW CARD
                        </a>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="ps-4">ID</th>
                                        <th>User ID</th>
                                        <th>Title</th>
                                        <th>Message</th>
                                        <th class="text-center">Created At</th>
                                        <th class="text-center">Updated At</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cards as $card)
                                        <tr>
                                            <td class="ps-4">
                                                <span class="fw-light ">{{ $card->id }}</span>
                                            </td>
                                            <td>
                                                <span class="fw-light">{{ $card->user_id }}</span>
                                            </td>
                                            <td>
                                                <span class="fw-light">{{ $card->title }}</span>
                                            </td>
                                            <td>
                                                <span class="fw-light">{{ $card->message }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="fw-light small">{{ $card->created_at }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="fw-light small">{{ $card->updated_at }}</span>
                                            </td>
                                            <td class="text-center pe-4">
                                                <form onsubmit="return confirm('Are You Sure?');" action="{{ route('cards.destroy', $card->id) }}" method="POST">
                                                    <div class="btn-group shadow-sm" role="group">
                                                        <a href="{{ route('cards.show', $card->id) }}" class="btn btn-outline-secondary btn-sm">VIEW</a>
                                                        <a href="{{ route('cards.edit', $card->id) }}" class="btn btn-outline-primary btn-sm">EDIT</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm">DELETE</button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-5">
                                                <div class="text-muted">
                                                    <p class="mb-0">No cards found in the database.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-center">
                    {{ $cards->links() }}
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // --- Theme Management ---
        const htmlElement = document.documentElement;
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');

        // Check for saved theme in localStorage, default to 'dark'
        const savedTheme = localStorage.getItem('theme') || 'dark';
        setTheme(savedTheme);

        themeToggle.addEventListener('click', () => {
            const currentTheme = htmlElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            setTheme(newTheme);
        });

        function setTheme(theme) {
            htmlElement.setAttribute('data-bs-theme', theme);
            localStorage.setItem('theme', theme);

            // Update Icon
            if (theme === 'dark') {
                themeIcon.classList.replace('bi-moon-stars-fill', 'bi-sun-fill');
            } else {
                themeIcon.classList.replace('bi-sun-fill', 'bi-moon-stars-fill');
            }
        }

        // --- SweetAlert Notifications ---
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });

        @if(session('success'))
            Toast.fire({ icon: 'success', title: '{{ session("success") }}' });
        @elseif(session('error'))
            Toast.fire({ icon: 'error', title: '{{ session("error") }}' });
        @endif
    </script>
</body>
</html>
