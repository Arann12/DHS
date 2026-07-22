# Design System: DHS Web Design System

**Project ID:** 10300691936792959013

## 1. Visual Theme & Atmosphere

The visual identity of DHS (Denpasar Hotel School) is anchored in **Corporate / Modern** principles with a heavy lean toward **Minimalism** and **Resort Luxury**. It evokes the prestige of an international hospitality training center with 35+ years of heritage (since 1989), combined with the warmth of Balinese hospitality.

The design should feel:

- **Elegan & Timeless:** Classic serif headlines, high-contrast typography, and generous whitespace.
- **Warm & Sophisticated:** Achieved via a palette of creams, warm beiges, and deep navy blue.
- **Professional & International:** Reinforced by clean, neutral sans-serif body text and a structured layout.
- **Voice & Tone:** Formal but warm, welcoming, and elite—avoiding decorative clutter in favor of high-quality photography and generous spacing.

## 2. Color Palette & Roles

The color palette represents a refined hospitality environment. It uses the official logo brand colors (Bright Red + Navy Blue) balanced with warm resort tones.

| Descriptive Name      | HEX Code  | Functional Role                                                                                                                                                            |
| :-------------------- | :-------- | :------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **DHS Royal Blue**    | `#0010B8` | Primary dominant color (~70% usage). Used for major headings, navigation bar text, solid primary CTA buttons, and main body text. Matches the logo's royal blue exactly.   |
| **DHS Red**           | `#DF1501` | Accent color (~10% usage). Used sparingly for small focus elements: icons, quote highlights, categories/badges (e.g., "Pendaftaran Dibuka"), and the active tab underline. Matches the logo's red exactly. |
| **Cream / Off-White** | `#F6F2EA` | Primary background color for major sections.                                                                                                                               |
| **Warm Beige**        | `#EFE7D8` | Alternating section background color (e.g., Visionary Standards, Footer) to separate sections without using lines.                                                         |
| **Deep Royal Blue**   | `#000B82` | Secondary body text. A deeper shade of the logo blue for paragraph copy and surface elements.                                                                              |
| **Muted Gray**        | `#6B6558` | Small capitalization labels (overlines). _Note: Ensure `#6B6558` or darker is used to maintain WCAG AA contrast compliance._                                               |
| **White**             | `#FFFFFF` | Background for cards, form fields, and text labels placed on top of Navy or Red backgrounds.                                                                               |

### Color Rules:

- **Navy Dominance:** Navy must remain the dominant color. Red is strictly an accent and should never cover large surface areas (like background sections) to avoid looking too aggressive.
- **Contrast Compliance:** Avoid gray text on Red backgrounds. White text on Navy or Red is fully compliant.

## 3. Typography Rules

Typography balances editorial elegance with modern legibility.

- **Headlines (H1/H2):** Serif font style (Playfair Display / Georgia / Canela). Used for large, confident titles. High editorial styling with slightly tighter letter-spacing for large text.
- **Body Text:** Sans-serif font style (Inter / Helvetica). Used for paragraphs, general descriptions, and smaller text.
- **Label Caps (Overlines):** Sans-serif (Inter) in all-caps, small size, with wide letter-spacing.
- **Tombol (CTA):** Sans-serif (Inter) in all-caps, medium weight.
- **Section Rhythm:** Every major section must follow the visual sequence: **Label kecil kapital (Overline) → Heading serif besar (H1/H2) → Body sans-serif**.
- **Language Policy:** Bahasa Indonesia is the primary language. Industry-specific terms (e.g., _Culinary Arts_, _Food & Beverage Service_, _Front Office_) remain in English and can be italicized.

## 4. Component Stylings

- **Buttons:**
    - **Primary CTA:** Solid DHS Navy Blue (`#1B2A6B`) background, white text, uppercase, strictly sharp corners (0px border-radius). Text must be descriptive (e.g., "JELAJAHI PROGRAM").
    - **Secondary CTA:** Transparent background, thin 1px DHS Navy Blue (`#1B2A6B`) border, DHS Navy Blue text, uppercase, sharp corners (0px border-radius).
- **Cards/Containers:**
    - Shape: Strictly sharp corners (0px border-radius) for all cards and image frames.
    - Background: White (`#FFFFFF`).
    - Shadow: Soft, large-radius ambient shadow (e.g., `0px 10px 40px rgba(28, 26, 23, 0.04)`) to create depth.
    - Content: Image at the top with a consistent aspect ratio (e.g., 3:4 or 4:5), uppercase small label, serif title, 1-2 sentence description, and all-caps "PROGRAM DETAILS" link at the bottom.
- **Inputs/Forms:**
    - Shape: Sharp corners (0px border-radius).
    - Borders: Minimalist design—either a thin 1px full border or a bottom-border only.
    - Colors: White background, placeholder text in Muted Gray.
- **Navigation:**
    - Minimalist top bar. Left-aligned logo, center/right menu: _Beranda · Tentang Kami · Akademi · Berita · Karier_.
    - Active menu indicator: Underline in DHS Red (`#D62828`).
- **Footer:**
    - Background: Warm Beige (`#EFE7D8`).
    - Structure: Left column with logo, school name, brief description, and social media links. Right columns with grouped links ("Explore" and "Admissions"), plus sitemap, privacy policies, and newsletter signup.

## 5. Layout Principles

- **Whitespace & Padding:** Generous vertical padding (`120px` on desktop) between sections to convey "resort luxury". On mobile, stack all columns, reduce padding to `64px`, and set margins of `20px` on all edges.
- **Grid Structure (12-column desktop):**
    - **2-Column Grid:** Standard for introductory segments (e.g., text on the left, supporting image on the right).
    - **3-Column Grid:** Standard for program cards, gallery highlights, and news grids.
    - **4-Column/Multi-Column Grid:** For team grids (e.g., Executive Leadership).
- **Alignment:** Left-alignment for all text and content groups to maintain a clean vertical grid.
- **Photography Style:** Warm interior light, warm wood tones, and natural campus sunlight. Human portraits of students should feature formal uniforms (maroon blazers). Maintain identical aspect ratios for all images inside a single card grid.

---

## 6. Page Consistency Checklist

Before finalizing or publishing any new page generated via Stitch, verify:

- [ ] The H1 title of the page matches the corresponding nav bar link label.
- [ ] No placeholder or template text remains in CTA buttons (must be descriptive).
- [ ] Language is consistent (Bahasa Indonesia with specific English hospitality terms).
- [ ] Colors and typography align exactly with Section 2 and Section 3 (strictly Navy primary, Red accent, cream/beige backgrounds).
- [ ] Every card or list link leads to a valid path or detail page (no dead-ends).
- [ ] The navigation bar and footer are identical across all pages.
- [ ] Aspect ratios of images inside card grids are consistent.
