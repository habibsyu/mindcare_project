@extends('layouts.app')

@section('title', "- {$content->title}")
@section('description', $content->excerpt)

@section('content')
<div class="min-h-screen py-12 transition-colors duration-300"
     :class="{ 'bg-gray-50': !darkMode, 'bg-gray-900': darkMode }">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center mb-4">
                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $content->type === 'article' ? 'bg-green-100 text-green-800' : ($content->type === 'video' ? 'bg-red-100 text-red-800' : 'bg-purple-100 text-purple-800') }}">
                    {{ ucfirst($content->type) }}
                </span>
                @if($content->category)
                <span class="ml-2 px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    {{ $content->category }}
                </span>
                @endif
            </div>
            
            <h1 class="text-3xl font-bold mb-4 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                {{ $content->title }}
            </h1>
            
            <div class="flex items-center justify-between text-sm transition-colors duration-300"
                 :class="{ 'text-gray-600': !darkMode, 'text-gray-400': darkMode }">
                <div class="flex items-center space-x-4">
                    <span>
                        <i class="fas fa-eye mr-1"></i>
                        {{ number_format($content->views) }} views
                    </span>
                    <span>
                        <i class="fas fa-heart mr-1"></i>
                        {{ number_format($content->likes) }} likes
                    </span>
                    @if($content->reading_time)
                    <span>
                        <i class="fas fa-clock mr-1"></i>
                        {{ $content->reading_time }} min baca
                    </span>
                    @endif
                </div>
                
                <div class="text-sm transition-colors duration-300"
                     :class="{ 'text-gray-500': !darkMode, 'text-gray-400': darkMode }">
                    {{ $content->published_at->format('d M Y') }}
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="rounded-2xl overflow-hidden mb-8 transition-colors duration-300"
             :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }">
            
            @if($content->type === 'video' && $content->video_url)
            <!-- Video Content -->
            <div class="aspect-video">
                @if($content->youtube_video_id)
                <iframe src="https://www.youtube.com/embed/{{ $content->youtube_video_id }}" 
                        class="w-full h-full" 
                        frameborder="0" 
                        allowfullscreen></iframe>
                @else
                <video controls class="w-full h-full">
                    <source src="{{ $content->video_url }}" type="video/mp4">
                    Browser Anda tidak mendukung video.
                </video>
                @endif
            </div>
            @elseif($content->thumbnail)
            <!-- Featured Image -->
            <img src="{{ $content->thumbnail }}" alt="{{ $content->title }}" class="w-full h-64 object-cover">
            @endif
            
            <div class="p-8">
                @if($content->excerpt)
                <div class="text-lg mb-6 transition-colors duration-300"
                     :class="{ 'text-gray-700': !darkMode, 'text-gray-300': darkMode }">
                    {{ $content->excerpt }}
                </div>
                @endif
                
                <div class="prose max-w-none transition-colors duration-300"
                     :class="{ 'prose-gray': !darkMode, 'prose-invert': darkMode }">
                    {!! $content->body !!}
                </div>
            </div>
        </div>

        <!-- Quiz Section -->
        @if($content->type === 'quiz' && $content->quiz_data)
        <div class="rounded-2xl p-8 mb-8 transition-colors duration-300"
             :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }"
             x-data="quizApp()">
            <h2 class="text-xl font-semibold mb-6 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Kuis Interaktif
            </h2>
            
            <div x-show="!showResults">
                <div class="mb-4">
                    <div class="flex justify-between text-sm font-medium mb-2 transition-colors duration-300"
                         :class="{ 'text-gray-700': !darkMode, 'text-gray-300': darkMode }">
                        <span>Progress</span>
                        <span x-text="`${currentQuestion + 1} dari {{ count($content->quiz_data['questions']) }}`"></span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" 
                             :style="`width: ${((currentQuestion + 1) / {{ count($content->quiz_data['questions']) }}) * 100}%`"></div>
                    </div>
                </div>
                
                @foreach($content->quiz_data['questions'] as $index => $question)
                <div x-show="currentQuestion === {{ $index }}" class="mb-6">
                    <h3 class="text-lg font-medium mb-4 transition-colors duration-300"
                        :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                        {{ $index + 1 }}. {{ $question['question'] }}
                    </h3>
                    
                    <div class="space-y-3">
                        @foreach($question['options'] as $optionIndex => $option)
                        <label class="block p-4 border rounded-lg cursor-pointer transition-colors duration-200"
                               :class="{ 
                                   'border-blue-500 bg-blue-50': answers[{{ $index }}] === {{ $optionIndex }},
                                   'border-gray-300 hover:bg-gray-50': !darkMode && answers[{{ $index }}] !== {{ $optionIndex }},
                                   'border-gray-600 hover:bg-gray-700': darkMode && answers[{{ $index }}] !== {{ $optionIndex }}
                               }"
                               @click="selectAnswer({{ $index }}, {{ $optionIndex }})">
                            <div class="flex items-center">
                                <input type="radio" 
                                       name="question_{{ $index }}" 
                                       value="{{ $optionIndex }}"
                                       x-model="answers[{{ $index }}]"
                                       class="sr-only">
                                <div class="flex-shrink-0 w-5 h-5 rounded-full border-2 mr-3 transition-colors duration-200"
                                     :class="answers[{{ $index }}] === {{ $optionIndex }} ? 'border-blue-500 bg-blue-500' : 'border-gray-300'">
                                    <div class="w-full h-full rounded-full bg-white transform scale-50 transition-transform duration-200"
                                         :class="answers[{{ $index }}] === {{ $optionIndex }} ? 'scale-50' : 'scale-0'"></div>
                                </div>
                                <span class="transition-colors duration-300"
                                      :class="{ 'text-gray-700': !darkMode, 'text-gray-300': darkMode }">
                                    {{ $option }}
                                </span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach
                
                <div class="flex justify-between">
                    <button type="button" 
                            @click="previousQuestion"
                            x-show="currentQuestion > 0"
                            class="px-6 py-3 border rounded-lg transition-colors duration-200"
                            :class="{ 'border-gray-300 text-gray-700 hover:bg-gray-50': !darkMode, 'border-gray-600 text-gray-300 hover:bg-gray-700': darkMode }">
                        Sebelumnya
                    </button>
                    
                    <button type="button" 
                            @click="nextQuestion"
                            x-show="currentQuestion < {{ count($content->quiz_data['questions']) - 1 }}"
                            :disabled="answers[currentQuestion] === undefined"
                            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200">
                        Selanjutnya
                    </button>
                    
                    <button type="button" 
                            @click="submitQuiz"
                            x-show="currentQuestion === {{ count($content->quiz_data['questions']) - 1 }}"
                            :disabled="!isComplete"
                            class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200">
                        Selesai
                    </button>
                </div>
            </div>
            
            <div x-show="showResults" class="text-center">
                <h3 class="text-2xl font-bold mb-4 transition-colors duration-300"
                    :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                    Hasil Kuis
                </h3>
                <div class="text-4xl font-bold text-blue-600 mb-4" x-text="`${score}/${totalQuestions}`"></div>
                <div class="text-lg mb-6 transition-colors duration-300"
                     :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }"
                     x-text="`Skor: ${Math.round((score/totalQuestions)*100)}%`"></div>
                
                <button @click="resetQuiz" 
                        class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    Coba Lagi
                </button>
            </div>
        </div>

        <script>
        function quizApp() {
            return {
                currentQuestion: 0,
                answers: {},
                showResults: false,
                score: 0,
                totalQuestions: {{ count($content->quiz_data['questions']) }},
                
                selectAnswer(questionIndex, answerIndex) {
                    this.answers[questionIndex] = answerIndex;
                },
                
                nextQuestion() {
                    if (this.currentQuestion < this.totalQuestions - 1 && this.answers[this.currentQuestion] !== undefined) {
                        this.currentQuestion++;
                    }
                },
                
                previousQuestion() {
                    if (this.currentQuestion > 0) {
                        this.currentQuestion--;
                    }
                },
                
                get isComplete() {
                    return Object.keys(this.answers).length === this.totalQuestions;
                },
                
                submitQuiz() {
                    if (this.isComplete) {
                        this.calculateScore();
                        this.showResults = true;
                    }
                },
                
                calculateScore() {
                    const questions = @json($content->quiz_data['questions']);
                    this.score = 0;
                    
                    questions.forEach((question, index) => {
                        if (this.answers[index] === question.correct) {
                            this.score++;
                        }
                    });
                },
                
                resetQuiz() {
                    this.currentQuestion = 0;
                    this.answers = {};
                    this.showResults = false;
                    this.score = 0;
                }
            }
        }
        </script>
        @endif

        <!-- Interaction Buttons -->
        @auth
        <div class="flex items-center justify-center space-x-4 mb-8">
            <button onclick="toggleLike({{ $content->id }})" 
                    data-like-btn="{{ $content->id }}"
                    class="flex items-center px-4 py-2 rounded-lg transition-colors duration-200 {{ in_array('like', $userInteractions) ? 'text-red-500' : '' }}"
                    :class="{ 'bg-white hover:bg-gray-50': !darkMode, 'bg-gray-800 hover:bg-gray-700': darkMode }">
                <i class="fas fa-heart mr-2 {{ in_array('like', $userInteractions) ? 'text-red-500' : '' }}"></i>
                <span data-like-count="{{ $content->id }}">{{ $content->likes }}</span>
            </button>
            
            <button onclick="toggleBookmark({{ $content->id }})" 
                    data-bookmark-btn="{{ $content->id }}"
                    class="flex items-center px-4 py-2 rounded-lg transition-colors duration-200 {{ in_array('bookmark', $userInteractions) ? 'text-yellow-500' : '' }}"
                    :class="{ 'bg-white hover:bg-gray-50': !darkMode, 'bg-gray-800 hover:bg-gray-700': darkMode }">
                <i class="fas fa-bookmark mr-2 {{ in_array('bookmark', $userInteractions) ? 'text-yellow-500' : '' }}"></i>
                Bookmark
            </button>
            
            <button onclick="shareContent({{ $content->id }})" 
                    class="flex items-center px-4 py-2 rounded-lg transition-colors duration-200"
                    :class="{ 'bg-white hover:bg-gray-50': !darkMode, 'bg-gray-800 hover:bg-gray-700': darkMode }">
                <i class="fas fa-share mr-2"></i>
                Share
            </button>
        </div>
        @endauth

        <!-- Related Content -->
        @if(count($relatedContent) > 0)
        <div class="rounded-2xl p-8 transition-colors duration-300"
             :class="{ 'bg-white shadow-lg': !darkMode, 'bg-gray-800 shadow-xl': darkMode }">
            <h2 class="text-xl font-semibold mb-6 transition-colors duration-300"
                :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                Konten Terkait
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedContent as $related)
                <a href="{{ route('content.show', $related) }}" 
                   class="block rounded-lg overflow-hidden transition-all duration-300 hover:scale-105"
                   :class="{ 'bg-gray-50 hover:shadow-md': !darkMode, 'bg-gray-700 hover:bg-gray-600': darkMode }">
                    @if($related->thumbnail)
                    <img src="{{ $related->thumbnail }}" alt="{{ $related->title }}" class="w-full h-32 object-cover">
                    @else
                    <div class="w-full h-32 flex items-center justify-center transition-colors duration-300"
                         :class="{ 'bg-gray-200': !darkMode, 'bg-gray-600': darkMode }">
                        <i class="fas fa-{{ $related->type === 'article' ? 'newspaper' : ($related->type === 'video' ? 'play' : 'question-circle') }} text-2xl transition-colors duration-300"
                           :class="{ 'text-gray-400': !darkMode, 'text-gray-500': darkMode }"></i>
                    </div>
                    @endif
                    
                    <div class="p-4">
                        <h3 class="font-medium mb-2 line-clamp-2 transition-colors duration-300"
                            :class="{ 'text-gray-900': !darkMode, 'text-white': darkMode }">
                            {{ $related->title }}
                        </h3>
                        <p class="text-sm line-clamp-2 transition-colors duration-300"
                           :class="{ 'text-gray-600': !darkMode, 'text-gray-300': darkMode }">
                            {{ $related->excerpt }}
                        </p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection