@php
    $success = session('success');
    $errors = $errors->any() ? $errors->all() : null;
@endphp

@if ($success || $errors)
    <div class="alert-container">
        @if ($success)
            <div class="alert success">
                {{ $success }}
            </div>
        @endif

        @if ($errors)
            <div class="alert error">
                <ul>
                    @foreach ($errors as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <style>
            .alert-container {
                margin-bottom: 20px;
            }

            .alert {
                padding: 15px;
                border-radius: 8px;
            }

            .alert.success {
                background-color: #d4edda;
                color: #155724;
                border: 1px solid #c3e6cb;
            }

            .alert.error {
                background-color: #f8d7da;
                color: #721c24;
                border: 1px solid #f5c6cb;
            }

            .alert ul {
                margin: 0;
                padding-left: 20px;
            }

            .alert li {
                margin-bottom: 5px;
            }
        </style>
    </div>
@endif