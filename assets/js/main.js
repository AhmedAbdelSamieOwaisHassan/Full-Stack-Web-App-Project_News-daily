// (() => {
//   const translations = {
//     en: {
//       home: "Home",
//       about: "About",
//       featured: "Featured",
//       contact: "Contact",
//       submit: "Submit Article",
//       login: "Login",
//       edit: "Edit News",
//       breaking: "Breaking: New policy changes reshape the global market.",
//       date: "Monday, 26 September 2026",
//       topStory: "TOP STORY",
//       readFullStory: "Read full story",
//       updated: "Updated 4 hours ago",
//       latestHeadlines: "Latest headlines",
//       seeAll: "See all",
//       readArticle: "Read article",
//       mostDiscussed: "Most discussed",
//       trendingNow: "Trending now",
//       aboutBadge: "About NewsDaily",
//       aboutTitle: "We report the stories that shape everyday life.",
//       aboutText1:
//         "NewsDaily is a modern digital publication focused on timely reporting, deeper analysis, and accessible journalism.",
//       aboutText2:
//         "Our mission is simple: help readers understand what matters, why it matters, and what comes next.",
//       dailyUpdates: "Daily updates",
//       dailyUpdatesText:
//         "Fresh reporting covering major stories across the world.",
//       expertViews: "Expert views",
//       expertViewsText:
//         "Context and analysis that helps readers form informed opinions.",
//       readerFirst: "Reader first",
//       readerFirstText:
//         "Built for clear reading, quick discovery, and accessible design.",
//       contactBadge: "Contact us",
//       contactTitle: "Let’s talk",
//       contactText:
//         "We’d love to hear from journalists, partners, and readers who want to connect with us.",
//       emailLabel: "Email:",
//       phoneLabel: "Phone:",
//       officeLabel: "Office:",
//       sendMessage: "Send message",
//       loginBadge: "Login",
//       loginTitle: "Welcome back",
//       rememberMe: "Remember me",
//       forgotPassword: "Forgot password?",
//       signIn: "Sign in",
//       submitBadge: "Submit article",
//       submitTitle: "Publish a new story",
//       articleTitle: "Article title",
//       category: "Category",
//       author: "Author",
//       shortSummary: "Short summary",
//       articleContent: "Article content",
//       publishArticle: "Publish article",
//       editBadge: "Edit article",
//       editTitle: "Update existing story",
//       saveChanges: "Save changes",
//       moreStories: "More stories",
//       footerText:
//         "Your trusted source for world, business, and technology stories.",
//       rights: "© 2026 NewsDaily. All rights reserved.",
//     },
//     ar: {
//       home: "الرئيسية",
//       about: "من نحن",
//       featured: "مميز",
//       contact: "تواصل معنا",
//       submit: "إضافة خبر",
//       login: "تسجيل الدخول",
//       edit: "تعديل الأخبار",
//       breaking:
//         "الأخبار العاجلة: تغييرات جديدة في السياسة تشكل سوقًا عالميًا جديدًا.",
//       date: "الاثنين، 26 سبتمبر 2026",
//       topStory: "أهم الخبر",
//       readFullStory: "اقرأ القصة كاملة",
//       updated: "تم التحديث منذ 4 ساعات",
//       latestHeadlines: "آخر العناوين",
//       seeAll: "عرض الجميع",
//       readArticle: "اقرأ الخبر",
//       mostDiscussed: "الأكثر مناقشة",
//       trendingNow: "الأكثر رواجًا",
//       aboutBadge: "عن نيوزداي",
//       aboutTitle: "نغطي القصص التي تشكل حياة الناس اليومية.",
//       aboutText1:
//         "نيوزداي هي منشور رقمي حديث يركز على الأخبار العاجلة والتحليل الأعمق والصحافة المتاحة للجميع.",
//       aboutText2:
//         "مهمتنا بسيطة: مساعدة القراء على فهم ما يهم، لماذا يهم، وما الذي سيأتي بعده.",
//       dailyUpdates: "تحديثات يومية",
//       dailyUpdatesText: "تغطية مستمرة للأخبار المهمة في جميع أنحاء العالم.",
//       expertViews: "آراء الخبراء",
//       expertViewsText: "سياق وتحليل يساعد القراء على تكوين آراء مستنيرة.",
//       readerFirst: "أولويتنا القارئ",
//       readerFirstText:
//         "مصمم للقراءة الواضحة والاكتشاف السريع والتصميم السهل الوصول.",
//       contactBadge: "تواصل معنا",
//       contactTitle: "دعنا نتحدث",
//       contactText:
//         "نود أن نسمع من الصحفيين والشركاء والقراء الراغبين في التواصل معنا.",
//       emailLabel: "البريد الإلكتروني:",
//       phoneLabel: "الهاتف:",
//       officeLabel: "المكتب:",
//       sendMessage: "إرسال الرسالة",
//       loginBadge: "تسجيل الدخول",
//       loginTitle: "مرحبًا بعودتك",
//       rememberMe: "تذكرني",
//       forgotPassword: "هل نسيت كلمة المرور؟",
//       signIn: "تسجيل الدخول",
//       submitBadge: "إضافة خبر",
//       submitTitle: "نشر قصة جديدة",
//       articleTitle: "عنوان المقال",
//       category: "الفئة",
//       author: "الكاتب",
//       shortSummary: "ملخص قصير",
//       articleContent: "محتوى المقال",
//       publishArticle: "نشر المقال",
//       editBadge: "تعديل المقال",
//       editTitle: "تحديث قصة موجودة",
//       saveChanges: "حفظ التغييرات",
//       moreStories: "قصص أخرى",
//       footerText: "مصدرك الموثوق للأخبار العالمية والأعمال والتقنية.",
//       rights: "© 2026 NewsDaily. جميع الحقوق محفوظة.",
//     },
//   };

//   function applyLanguage(lang) {
//     const safeLang = translations[lang] ? lang : "en";
//     const isArabic = safeLang === "ar";

//     document.documentElement.lang = safeLang;
//     document.documentElement.dir = isArabic ? "rtl" : "ltr";
//     document.body.dir = isArabic ? "rtl" : "ltr";

//     document.querySelectorAll("[data-i18n]").forEach((element) => {
//       const key = element.dataset.i18n;
//       if (translations[safeLang][key]) {
//         element.textContent = translations[safeLang][key];
//       }
//     });

//     document.querySelectorAll("[data-lang]").forEach((button) => {
//       button.classList.toggle("active", button.dataset.lang === safeLang);
//     });

//     localStorage.setItem("newsLang", safeLang);

//     const url = new URL(window.location.href);
//     url.searchParams.set("lang", safeLang);
//     window.history.replaceState({}, "", url);
//   }

//   document.addEventListener("DOMContentLoaded", () => {
//     const params = new URLSearchParams(window.location.search);
//     const savedLang =
//       params.get("lang") || localStorage.getItem("newsLang") || "en";
//     applyLanguage(savedLang);

//     document.querySelectorAll("[data-lang]").forEach((button) => {
//       button.addEventListener("click", () =>
//         applyLanguage(button.dataset.lang),
//       );
//     });
//   });
// })();
