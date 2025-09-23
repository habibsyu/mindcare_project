@extends('layouts.app')

@section('title', "- {$config['name']}")

@section('content')
<div class="min-h-screen py-12 transition-colors duration-300"
     :class="{ 'bg-gray-50': !darkMode, 'bg-gray-900': darkMode }"
     x-data="assessmentForm()">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold mb-4 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                {{ $config['name'] }}
            </h1>
            <p class="text-lg transition-colors duration-300"
               :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                {{ $config['description'] }}
            </p>
        </div>

        <!-- Progress Bar -->
        <div class="mb-8">
            <div class="flex justify-between text-sm font-medium mb-2 transition-colors duration-300"
                 :class="{ 'text-gray-700': !darkMode, 'text-gray-300': darkMode }">
                <span>Progress</span>
                <span x-text="`${currentQuestion + 1} dari {{ count($config['questions']) }}`"></span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" 
                     :style="`width: ${((currentQuestion + 1) / {{ count($config['questions']) }}) * 100}%`"></div>
            </div>
        </div>

        <!-- Assessment Form -->
        <form method="POST" action="{{ route('assessments.submit', $type) }}" 
              @submit.prevent="submitForm" class="space-y-8">
            @csrf
            
            @foreach($config['questions'] as $index => $question)
            <div class="rounded-2xl p-8 shadow-lg transition-all duration-300"
                 :class="{ 'bg-white': !darkMode, 'bg-gray-800': darkMode }"
                 x-show="currentQuestion === {{ $index }}"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-x-8"
                 x-transition:enter-end="opacity-100 transform translate-x-0">
                
                <h2 class="text-xl font-semibold mb-6 transition-colors duration-300"
                    :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                    {{ $index + 1 }}. {{ $question }}
                </h2>
                
                <div class="space-y-3">
                    @foreach($config['options'] as $value => $option)
                    <label class="assessment-option cursor-pointer"
                           :class="{ 
                               'selected': answers[{{ $index }}] === {{ $value }},
                               'bg-white hover:bg-gray-50 border-gray-200': !darkMode,
                               'bg-gray-800 hover:bg-gray-700 border-gray-600': darkMode
                           }"
                           @click="selectAnswer({{ $index }}, {{ $value }})">
                        <div class="flex items-center">
                            <input type="radio" 
                                   name="answers[{{ $index }}]" 
                                   value="{{ $value }}"
                                   x-model="answers[{{ $index }}]"
                                   class="sr-only">
                            <div class="flex-shrink-0 w-5 h-5 rounded-full border-2 mr-4 transition-colors duration-200"
                                 :class="answers[{{ $index }}] === {{ $value }} ? 'border-blue-500 bg-blue-500' : 'border-gray-300'">
                                <div class="w-full h-full rounded-full bg-white transform scale-50 transition-transform duration-200"
                                     :class="answers[{{ $index }}] === {{ $value }} ? 'scale-50' : 'scale-0'"></div>
                            </div>
                            <span class="text-sm transition-colors duration-300"
                                  :class="{ 'text-gray-700': !darkMode, 'text-gray-300': darkMode }">
                                {{ $option }}
                            </span>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>
            @endforeach

            <!-- Navigation Buttons -->
            <div class="flex justify-between items-center pt-8">
                <button type="button" 
                        @click="previousQuestion"
                        x-show="currentQuestion > 0"
                        class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-sm font-medium transition-colors duration-200"
                        :class="{ 'text-gray-700 bg-white hover:bg-gray-50': !darkMode, 'text-gray-300 bg-gray-800 hover:bg-gray-700 border-gray-600': darkMode }">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Sebelumnya
                </button>
                
                <div x-show="currentQuestion < {{ count($config['questions']) - 1 }}">
                    <button type="button" 
                            @click="nextQuestion"
                            :disabled="answers[currentQuestion] === undefined"
                            class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200">
                        Selanjutnya
                        <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </div>
                
                <div x-show="currentQuestion === {{ count($config['questions']) - 1 }}">
                    <button type="submit" 
                            :disabled="!isFormComplete"
                            class="inline-flex items-center px-8 py-3 border border-transparent rounded-lg text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200">
                        <i class="fas fa-check mr-2"></i>
                        Selesai
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function assessmentForm() {
    return {
        currentQuestion: 0,
        answers: {},
        
        selectAnswer(questionIndex, value) {
            this.answers[questionIndex] = value;
        },
        
        nextQuestion() {
            if (this.currentQuestion < {{ count($config['questions']) - 1 }} && this.answers[this.currentQuestion] !== undefined) {
                this.currentQuestion++;
            }
        },
        
        previousQuestion() {
            if (this.currentQuestion > 0) {
                this.currentQuestion--;
            }
        },
        
        get isFormComplete() {
            return Object.keys(this.answers).length === {{ count($config['questions']) }};
        },
        
        submitForm(event) {
            if (this.isFormComplete) {
                event.target.submit();
            }
        }
    }
}
</script>
@endsection