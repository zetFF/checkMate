<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Modern Todo App</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Updated Typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://unpkg.com/@floating-ui/core@1.5.0"></script>
    <script src="https://unpkg.com/@floating-ui/dom@1.5.0"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-[#F8FAFC] min-h-screen font-inter">
    <!-- Header with Logout -->
    <header class="w-full border-b border-gray-100 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                    <img width="100px" src="https://res.cloudinary.com/ddy7p8yrj/image/upload/v1741788561/b2vto9hri4zurpx5o25v.png" alt="">
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600 font-medium">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50 rounded-lg transition duration-200">
                            <i class="fas fa-sign-out-alt mr-2"></i>Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="p-8">
        <!-- Header & Search -->
        <div class="max-w-5xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-jakarta font-bold text-gray-900 tracking-tight">My Tasks</h2>
                    <p class="text-gray-500 font-medium tracking-wide mt-1">{{ now()->format('l, F j, Y') }}</p>
                </div>
                <div class="relative w-96">
                    <form action="{{ route('todos.index') }}" method="GET">
                        <input type="text"
                               name="search"
                               class="w-full pl-12 pr-4 py-2.5 rounded-xl border border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors duration-200 font-medium"
                               placeholder="Search tasks..."
                               value="{{ request('search') }}">
                        <span class="absolute left-4 top-3 text-gray-400">
                            <i class="fas fa-search"></i>
                        </span>
                    </form>
                </div>
            </div>

            <!-- Quick Add Task -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
                <h3 class="text-xl font-jakarta font-semibold text-gray-900 mb-6 tracking-tight">Create New Task</h3>
                <form action="{{ route('todos.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1 tracking-wide">Task Name</label>
                                <input type="text"
                                       name="name"
                                       class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                                       placeholder="Enter task name"
                                       required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1 tracking-wide">Description</label>
                                <textarea name="description"
                                          class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                                          rows="3"
                                          placeholder="Add task details"
                                          required></textarea>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1 tracking-wide">Priority Level</label>
                                <div x-data="{ open: false, selected: '' }" class="relative">
                                    <button type="button"
                                            @click="open = !open"
                                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-left flex items-center justify-between font-medium focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                                        <div class="flex items-center space-x-3">
                                            <template x-if="selected">
                                                <div class="flex items-center space-x-3">
                                                    <div class="w-2 h-2 rounded-full"
                                                         :class="{
                                                            'bg-red-500': selected === 'high',
                                                            'bg-yellow-500': selected === 'medium',
                                                            'bg-blue-500': selected === 'low'
                                                         }">
                                                    </div>
                                                    <span x-text="selected.charAt(0).toUpperCase() + selected.slice(1) + ' Priority'"
                                                          :class="{
                                                            'text-red-700': selected === 'high',
                                                            'text-yellow-700': selected === 'medium',
                                                            'text-blue-700': selected === 'low'
                                                          }">
                                                    </span>
                                                </div>
                                            </template>
                                            <template x-if="!selected">
                                                <span class="text-gray-500">Select Priority</span>
                                            </template>
                                        </div>
                                        <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"
                                           :class="{ 'transform rotate-180': open }"></i>
                                    </button>

                                    <div x-show="open"
                                         @click.away="open = false"
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 transform scale-95"
                                         x-transition:enter-end="opacity-100 transform scale-100"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="opacity-100 transform scale-100"
                                         x-transition:leave-end="opacity-0 transform scale-95"
                                         class="absolute z-50 mt-2 w-full bg-white rounded-xl shadow-lg border border-gray-100 py-2">

                                        <div @click="selected = 'high'; open = false"
                                             class="px-4 py-2.5 flex items-center justify-between hover:bg-gray-50 cursor-pointer">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                                <span class="text-red-700">High Priority</span>
                                            </div>
                                            <i class="fas fa-check text-red-500" x-show="selected === 'high'"></i>
                                        </div>

                                        <div @click="selected = 'medium'; open = false"
                                             class="px-4 py-2.5 flex items-center justify-between hover:bg-gray-50 cursor-pointer">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 rounded-full bg-yellow-500"></div>
                                                <span class="text-yellow-700">Medium Priority</span>
                                            </div>
                                            <i class="fas fa-check text-yellow-500" x-show="selected === 'medium'"></i>
                                        </div>

                                        <div @click="selected = 'low'; open = false"
                                             class="px-4 py-2.5 flex items-center justify-between hover:bg-gray-50 cursor-pointer">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                                                <span class="text-blue-700">Low Priority</span>
                                            </div>
                                            <i class="fas fa-check text-blue-500" x-show="selected === 'low'"></i>
                                        </div>
                                    </div>

                                    <input type="hidden" name="priority" x-model="selected" required>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1 tracking-wide">Due Date</label>
                                <input type="datetime-local"
                                       name="due_date"
                                       class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                                class="px-6 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition-colors duration-200 flex items-center font-medium tracking-wide">
                            <i class="fas fa-plus mr-2"></i>
                            Add New Task
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tasks List -->
            <div class="space-y-4">
                @foreach($todos as $todo)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div>
                                <input type="checkbox"
                                       class="toggle-complete w-5 h-5 rounded-lg border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                       data-id="{{ $todo->id }}"
                                       {{ $todo->is_completed ? 'checked' : '' }}>
                            </div>
                            <div>
                                <h3 class="text-lg font-jakarta font-semibold text-gray-900 tracking-tight {{ $todo->is_completed ? 'line-through text-gray-400' : '' }}">
                                    {{ $todo->name }}
                                </h3>
                                <p class="text-sm text-gray-500 mt-1 tracking-wide">{{ $todo->description }}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-6">
                            <div class="text-right">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium tracking-wide
                                    {{ $todo->priority === 'high' ? 'bg-red-100 text-red-700' :
                                       ($todo->priority === 'medium' ? 'bg-yellow-100 text-yellow-700' :
                                       'bg-blue-100 text-blue-700') }}">
                                    <i class="fas fa-flag mr-2 text-xs"></i>
                                    {{ ucfirst($todo->priority) }}
                                </span>
                                <p class="text-sm text-gray-500 mt-1 tracking-wide">
                                    <i class="far fa-clock mr-1"></i>
                                    {{ $todo->due_date->format('M j, g:i A') }}
                                </p>
                            </div>
                            <div class="flex space-x-2">
                                <button class="edit-todo p-2 text-gray-400 hover:text-indigo-600 transition-colors duration-200"
                                        data-id="{{ $todo->id }}"
                                        data-name="{{ $todo->name }}"
                                        data-description="{{ $todo->description }}"
                                        data-priority="{{ $todo->priority }}"
                                        data-due-date="{{ $todo->due_date->format('Y-m-d\TH:i') }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="p-2 text-gray-400 hover:text-red-600 transition-colors duration-200"
                                            onclick="return confirm('Are you sure you want to delete this task?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl shadow-xl max-w-2xl w-full mx-4 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-xl font-jakarta font-semibold text-gray-900 tracking-tight">Edit Task</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form id="editForm" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1 tracking-wide">Task Name</label>
                                <input type="text" name="name" class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1 tracking-wide">Description</label>
                                <textarea name="description" class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1 tracking-wide">Priority Level</label>
                                <div x-data="{ open: false, selected: '' }" class="relative">
                                    <button type="button"
                                            @click="open = !open"
                                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-left flex items-center justify-between font-medium focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                                        <div class="flex items-center space-x-3">
                                            <template x-if="selected">
                                                <div class="flex items-center space-x-3">
                                                    <div class="w-2 h-2 rounded-full"
                                                         :class="{
                                                            'bg-red-500': selected === 'high',
                                                            'bg-yellow-500': selected === 'medium',
                                                            'bg-blue-500': selected === 'low'
                                                         }">
                                                    </div>
                                                    <span x-text="selected.charAt(0).toUpperCase() + selected.slice(1) + ' Priority'"
                                                          :class="{
                                                            'text-red-700': selected === 'high',
                                                            'text-yellow-700': selected === 'medium',
                                                            'text-blue-700': selected === 'low'
                                                          }">
                                                    </span>
                                                </div>
                                            </template>
                                            <template x-if="!selected">
                                                <span class="text-gray-500">Select Priority</span>
                                            </template>
                                        </div>
                                        <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"
                                           :class="{ 'transform rotate-180': open }"></i>
                                    </button>

                                    <div x-show="open"
                                         @click.away="open = false"
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 transform scale-95"
                                         x-transition:enter-end="opacity-100 transform scale-100"
                                         x-transition:leave="transition ease-in duration-75"
                                         x-transition:leave-start="opacity-100 transform scale-100"
                                         x-transition:leave-end="opacity-0 transform scale-95"
                                         class="absolute z-50 mt-2 w-full bg-white rounded-xl shadow-lg border border-gray-100 py-2">

                                        <div @click="selected = 'high'; open = false"
                                             class="px-4 py-2.5 flex items-center justify-between hover:bg-gray-50 cursor-pointer">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                                <span class="text-red-700">High Priority</span>
                                            </div>
                                            <i class="fas fa-check text-red-500" x-show="selected === 'high'"></i>
                                        </div>

                                        <div @click="selected = 'medium'; open = false"
                                             class="px-4 py-2.5 flex items-center justify-between hover:bg-gray-50 cursor-pointer">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 rounded-full bg-yellow-500"></div>
                                                <span class="text-yellow-700">Medium Priority</span>
                                            </div>
                                            <i class="fas fa-check text-yellow-500" x-show="selected === 'medium'"></i>
                                        </div>

                                        <div @click="selected = 'low'; open = false"
                                             class="px-4 py-2.5 flex items-center justify-between hover:bg-gray-50 cursor-pointer">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                                                <span class="text-blue-700">Low Priority</span>
                                            </div>
                                            <i class="fas fa-check text-blue-500" x-show="selected === 'low'"></i>
                                        </div>
                                    </div>

                                    <input type="hidden" name="priority" x-model="selected" required>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1 tracking-wide">Due Date</label>
                                <input type="datetime-local" name="due_date" class="w-full px-4 py-2.5 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200" required>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button"
                                class="px-6 py-2.5 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors duration-200 font-medium tracking-wide"
                                onclick="closeModal()">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-6 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition-colors duration-200 font-medium tracking-wide">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        $(document).ready(function() {
            $('.toggle-complete').change(function() {
                const todoId = $(this).data('id');
                $.ajax({
                    url: `/todos/${todoId}/toggle`,
                    type: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        location.reload();
                    }
                });
            });

            $('.edit-todo').click(function() {
                const todo = $(this).data();
                const modal = $('#editModal');
                const form = modal.find('form');

                form.attr('action', `/todos/${todo.id}`);
                form.find('[name=name]').val(todo.name);
                form.find('[name=description]').val(todo.description);
                form.find('[name=priority]').val(todo.priority);
                form.find('[name=due_date]').val(todo.dueDate);

                modal.removeClass('hidden');
            });
        });
    </script>
</body>
</html>
