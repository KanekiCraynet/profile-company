# PT Lestari Jaya Bangsa - Company Profile System

A modern, comprehensive Laravel-based company profile website with advanced content management and customer interaction features for PT Lestari Jaya Bangsa, a leading herbal and processed food manufacturer in Indonesia.

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-^8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-4.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC34A?style=for-the-badge&logo=alpine.js&logoColor=white)

## 🏢 About PT Lestari Jaya Bangsa

PT Lestari Jaya Bangsa is a distinguished manufacturer of herbal products and processed foods, established in 1992 and headquartered in Jawa Tengah, Indonesia. With over three decades of expertise, the company specializes in producing high-quality, certified products including:

- **Herbal Products**: Traditional and modern herbal supplements
- **Processed Foods**: Premium food products with natural ingredients
- **Certified Products**: Halal, BPOM, and Natural certifications

## ✨ Key Features

### 🌐 Frontend Features
- **Responsive Design**: Mobile-first approach with modern UI/UX
- **Product Catalog**: Dynamic product showcase with categories and filtering
- **Article System**: Blog/news platform with SEO optimization
- **Interactive Chatbot**: AI-powered customer support 24/7
- **Contact Management**: Customer inquiry system with email notifications
- **Multi-language Support**: Configurable locale system
- **Dark Mode**: Theme switching capabilities
- **SEO Optimized**: Comprehensive meta tags and structured data

### 🔧 Admin Panel Features
- **Role-Based Access Control**: Three-tier permission system
  - **Super Admin**: Full system access and user management
  - **Admin**: Content and product management
  - **Marketing**: Article and content creation
- **Dashboard Analytics**: Real-time statistics and charts
- **Content Management**: Advanced article and blog management
- **Product Management**: CRUD operations with image uploads
- **User Management**: Admin user creation and role assignment
- **Contact Management**: Customer inquiry tracking
- **Settings Management**: System configuration and company information

### 🤖 Advanced Chatbot System
- **Rule-Based Messaging**: Intelligent response system
- **Rate Limiting**: Anti-spam protection (30/min, 200/hour per IP)
- **Conversation History**: Session-based chat tracking
- **Analytics**: Chat performance metrics and reporting
- **Admin Management**: Chatbot rule configuration and history viewing

## 🛠 Technical Architecture

### Backend Stack
- **Framework**: Laravel 12.x
- **Database**: SQLite (configurable to MySQL/PostgreSQL)
- **Queue System**: Redis/Database queues for background processing
- **Caching**: Redis/Database caching for performance
- **Authentication**: Laravel Sanctum + Spatie Permissions
- **File Management**: Spatie Media Library

### Frontend Stack
- **Build Tool**: Vite with Laravel plugin
- **CSS Framework**: Tailwind CSS v4
- **JavaScript**: Alpine.js for reactive components
- **Charts**: Chart.js for analytics visualization
- **Icons**: Lucide Vue Next
- **HTTP Client**: Axios for API communication

### Key Dependencies
```json
{
    "laravel/framework": "^12.0",
    "spatie/laravel-permission": "^6.0",
    "spatie/laravel-medialibrary": "^11.0",
    "laravel/pail": "^1.1",
    "tailwindcss": "^4.0",
    "alpinejs": "^3.14"
}
```

## 📁 Project Structure

```
profile-company/
├── app/
│   ├── Http/Controllers/           # Web Controllers
│   │   ├── Admin/                 # Admin Panel Controllers
│   │   ├── Frontend/              # Frontend Controllers
│   │   └── Api/                   # API Controllers
│   ├── Models/                    # Eloquent Models
│   ├── Services/                  # Business Logic Layer
│   ├── Policies/                  # Authorization Policies
│   └── Providers/                 # Service Providers
├── database/
│   ├── migrations/                # Database Migrations
│   ├── seeders/                   # Database Seeders
│   └── factories/                 # Model Factories
├── resources/
│   ├── views/                     # Blade Templates
│   │   ├── admin/                 # Admin Panel Views
│   │   ├── frontend/              # Frontend Views
│   │   └── components/            # Reusable Components
│   ├── css/                       # Tailwind CSS Styles
│   └── js/                        # JavaScript Files
├── Modules/                       # Custom Modules
│   ├── Admin/                     # Admin Module
│   ├── Chatbot/                   # Chatbot Module
│   └── Settings/                  # Settings Module
└── public/                        # Public Assets
```

## 🚀 Installation & Setup

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM/Yarn
- Git

### Installation Steps

1. **Clone the Repository**
```bash
git clone <repository-url>
cd profile-company
```

2. **Install Dependencies**
```bash
composer install
npm install
```

3. **Environment Configuration**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database Setup**
```bash
php artisan migrate
php artisan db:seed
```

5. **Link Storage**
```bash
php artisan storage:link
```

6. **Build Assets**
```bash
npm run build
# or for development
npm run dev
```

7. **Start Development Server**
```bash
php artisan serve
```

## 🔐 Authentication & Authorization

### Default Admin Credentials
- **Email**: `superadmin@ljs.com`
- **Password**: Check database seeder or set during setup

### Role System
1. **Super Admin**: Full system access, user management, settings
2. **Admin**: Products, articles, contacts, chatbot management
3. **Marketing**: Article creation and content management

### Access Control
- Route-based middleware protection
- Policy-based model access control
- Custom role middleware implementation

## 📊 Database Schema

### Core Models
- **User**: Authentication with role-based permissions
- **Product**: Product catalog with categories and media
- **Article**: Blog/news content with SEO metadata
- **Contact**: Customer inquiries with status tracking
- **ChatbotRule**: Chatbot response rules
- **ChatConversation**: Chat session management
- **Page**: Static content pages
- **Setting**: System configuration

### Key Relationships
- Products → Categories (Many-to-One)
- Articles → Categories, Tags, Author
- Users → Roles (Many-to-Many)
- Media → Models (Polymorphic)

## 🎨 Frontend Components

### Layout Components
- **Navbar**: Dynamic navigation with role-based menus
- **Sidebar**: Admin panel navigation
- **Footer**: Company information and links
- **Chat Widget**: Floating chat interface

### UI Components
- **Product Cards**: Responsive product display
- **Article Cards**: Blog/news content display
- **Contact Forms**: Customer inquiry forms
- **Admin Tables**: Data management interfaces
- **Charts**: Analytics visualization

## 🔧 Configuration

### Environment Variables
```env
APP_NAME="PT Lestari Jaya Bangsa"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Cache Configuration
```php
// config/cache.php
'default' => env('CACHE_DRIVER', 'redis'),

'redis' => [
    'driver' => 'redis',
    'connection' => 'cache',
],
```

## 📈 Performance Features

### Caching Strategy
- **Query Caching**: Database query result caching
- **View Caching**: Blade template caching
- **Route Caching**: Route optimization for production
- **Config Caching**: Configuration file caching

### Background Jobs
- **Email Processing**: Asynchronous email sending
- **Image Processing**: Media optimization jobs
- **Chat Analytics**: Conversation data processing

### Optimization Techniques
- **Asset Optimization**: Vite build optimization
- **Database Optimization**: Query optimization and indexing
- **Lazy Loading**: Image and content lazy loading
- **Code Splitting**: Dynamic component loading

## 🧪 Testing

### Run Tests
```bash
php artisan test
```

### Test Coverage
- Unit Tests for Services and Models
- Feature Tests for Controllers
- Browser Tests for User Interface
- API Tests for Endpoints

## 📝 Development Guidelines

### Code Standards
- **PSR-12**: PHP coding standards
- **Laravel Conventions**: Framework best practices
- **ESLint**: JavaScript code quality
- **Prettier**: Code formatting

### Git Workflow
- **Feature Branches**: Separate branches for new features
- **Pull Requests**: Code review process
- **Commit Messages**: Conventional commit format

### Security Best Practices
- **Input Validation**: Request validation rules
- **XSS Protection**: Output escaping and sanitization
- **CSRF Protection**: Built-in Laravel CSRF tokens
- **SQL Injection Prevention**: Eloquent ORM usage

## 🔄 Deployment

### Production Deployment
```bash
# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Run migrations
php artisan migrate --force

# Clear caches
php artisan cache:clear
php artisan config:clear
```

### Server Requirements
- **PHP**: 8.2 or higher
- **Web Server**: Nginx or Apache
- **Database**: MySQL 8.0+, PostgreSQL 13+, or SQLite
- **Redis**: For caching and queues (recommended)
- **Node.js**: For asset building

## 📞 Support & Contact

### Project Team
- **Development**: Laravel Development Team
- **Company**: PT Lestari Jaya Bangsa
- **Location**: Jawa Tengah, Indonesia

### Documentation
- **API Documentation**: Available in `/docs/api`
- **Admin Guide**: Available in `/docs/admin`
- **User Manual**: Available in `/docs/user`

## 📄 License

This project is licensed under the [MIT License](LICENSE).

## 🤝 Contributing

Contributions are welcome! Please read our [Contributing Guidelines](CONTRIBUTING.md) for details on our code of conduct and the process for submitting pull requests.

### Development Setup
1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 🔮 Future Roadmap

### Planned Features
- [ ] **E-commerce Integration**: Online ordering system
- [ ] **Multi-language Support**: Full internationalization
- [ ] **Mobile App**: React Native mobile application
- [ ] **Advanced Analytics**: Enhanced reporting dashboard
- [ ] **API Documentation**: Swagger/OpenAPI integration
- [ ] **Payment Gateway**: Integrated payment processing

### Technical Improvements
- [ ] **Microservices Architecture**: Service decomposition
- [ ] **Real-time Notifications**: WebSocket integration
- [ ] **Advanced Search**: Elasticsearch integration
- [ ] **CDN Integration**: Asset optimization
- [ ] **Monitoring**: Application performance monitoring

---

**Built with ❤️ for PT Lestari Jaya Bangsa**

*This comprehensive company profile system represents the digital transformation of traditional herbal and food manufacturing into the modern digital age.*
