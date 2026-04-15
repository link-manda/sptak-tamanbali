# Design System Document: The Sacred Modernist

## 1. Overview & Creative North Star: "The Digital Banjar"
The design system for **Desa Adat Tamanbali** moves beyond the cold, utilitarian nature of typical government portals. Our Creative North Star is **"The Digital Banjar"**—a concept that marries the communal, organic warmth of a Balinese meeting hall with the crystalline precision of modern governance. 

We reject the "boxed-in" layout. Instead, we use **Intentional Asymmetry** and **Editorial Spacing** to create a sense of breath and prestige. By overlapping delicate glass layers and using high-contrast typography, we guide the citizen’s eye through a narrative, not just a grid. This is an invitation to community, not just a transaction of data.

---

## 2. Colors & Tonal Depth

### The Palette
We use a sophisticated hierarchy of blues and Balinese-inspired accents to communicate authority and heritage.

*   **Primary (Trust):** `primary` (#00236f) and `primary_container` (#1E3A8A). Used for high-level branding and primary actions.
*   **Secondary (Heritage Gold):** `secondary` (#735c00). Represents the sacred "Wastra" (ceremonial cloth) of Bali, used for cultural highlights and achievements.
*   **Tertiary (Vitality Green):** `tertiary_fixed` (#6ffbbe). Used specifically for income/growth indicators.
*   **Error (Rose Red):** `error` (#ba1a1a). Used for expenses and critical alerts.

### The "No-Line" Rule
**Borders are forbidden for sectioning.** To define space, use:
1.  **Background Shifts:** Transition from `surface` (#f8f9fa) to `surface_container_low` (#f3f4f5).
2.  **Tonal Transitions:** A 48px vertical gap is more effective than a line.
3.  **Glassmorphism:** Use `surface_container_lowest` at 70% opacity with a 20px backdrop blur to create a floating boundary.

### Signature Textures
Main CTAs and Hero sections should utilize a subtle **radial gradient** from `primary` (#00236f) to `primary_container` (#1E3A8A). This prevents the "flat" government look and adds a premium, silk-like depth.

---

## 3. Typography: The Editorial Voice

We utilize a dual-font strategy to balance modernity with readability.

*   **Display & Headlines (Manrope):** Chosen for its geometric precision and modern "tech" feel. Use `display-lg` (3.5rem) with tighter letter-spacing (-0.02em) for hero titles to command attention.
*   **Body & Labels (Inter):** The workhorse. Its high x-height ensures legibility for village announcements. Use `body-md` (0.875rem) for standard reading.

**Hierarchy Note:** Always pair a `headline-lg` with a `title-sm` subheader in `secondary` (Gold) to emphasize the Balinese cultural context.

---

## 4. Elevation & Depth: The Layering Principle

Forget the Z-axis of 2014. Depth in this system is achieved through **Tonal Stacking**.

*   **The Layering Stack:**
    *   **Level 0 (Base):** `surface` (#f8f9fa)
    *   **Level 1 (Sections):** `surface_container_low` (#f3f4f5)
    *   **Level 2 (Cards):** `surface_container_lowest` (#ffffff)
*   **Ambient Shadows:** For floating glass elements, use a shadow: `0 20px 40px rgba(0, 35, 111, 0.05)`. This uses a blue tint rather than grey, making the shadow feel like a reflection of the sky over Tamanbali.
*   **The Ghost Border:** If a boundary is required for accessibility, use `outline_variant` (#c5c5d3) at **15% opacity**. It should be felt, not seen.

---

## 5. Components

### Glassmorphism Cards
Cards are the heart of the portal. 
*   **Corner Radius:** `xl` (1.5rem / 24px) for outer containers; `lg` (1rem / 16px) for inner elements.
*   **Background:** `rgba(255, 255, 255, 0.7)` with `backdrop-filter: blur(12px)`.
*   **Content:** No dividers. Use `body-lg` for headings and `label-md` for metadata, separated by 16px of whitespace.

### Zebra-Striped Tables (Financials)
To keep the "Clean Government" look, tables must be airy.
*   **Header:** `surface_container_high` with `title-sm` in `on_surface`.
*   **Rows:** Alternate between `surface` and `surface_container_low`.
*   **Borders:** 0px. Use 24px horizontal padding to give the data room to breathe.

### Buttons
*   **Primary:** `primary` background, `on_primary` text. `xl` (1.5rem) roundedness.
*   **Secondary (Cultural):** `secondary_container` background with `on_secondary_container` text. Use for "History" or "Culture" sections.
*   **Tertiary:** Transparent background with a `Ghost Border` and `primary` text.

### Input Fields
*   **State:** Neutral state uses `surface_container_highest` (#e1e3e4) as a background rather than an outline.
*   **Focus:** Shifts to `primary` with a 4px "soft glow" shadow.

---

## 6. Do’s and Don’ts

### Do:
*   **Do use whitespace as a separator.** If in doubt, double the padding.
*   **Do overlap elements.** Let a Glassmorphism card sit 20px over a header background to create a physical sense of layers.
*   **Do use the Heritage Gold (#735c00)** for icons or small labels to ground the modern UI in Balinese tradition.

### Don’t:
*   **Don’t use black (#000000).** Use `on_surface` (#191c1d) for text to maintain a soft, premium feel.
*   **Don’t use hard drop shadows.** If the shadow is clearly visible, it’s too dark.
*   **Don’t use 1px solid dividers.** Use background color shifts (`surface` vs `surface_container`) to define areas of the village portal.